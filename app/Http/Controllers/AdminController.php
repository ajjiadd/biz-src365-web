<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectFinance;
use App\Models\ProfitDistribution;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Deposit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Withdrawal;
use App\Models\SiteSetting;
use App\Models\Testimonial;


class AdminController extends Controller
{

    // ১. অ্যাডমিন ড্যাশবোর্ড লোড করা
    public function index()
    {
        $totalFund = DB::table('batch_user')->sum('invested_amount');
        $totalInvestors = User::where('role', 'investor')->count();
        
        // এখানে পরিবর্তন করা হয়েছে (open, funding এবং active সবগুলোকে কাউন্ট করবে)
        $activeBatchesCount = Batch::whereIn('status', ['open', 'funding', 'active'])->count(); 
        
        $totalProfitDistributed = ProfitDistribution::sum('total_profit');
        
        $batches = Batch::all(); // P&L ফর্মে ড্রপডাউনের জন্য
        $activeBatches = Batch::whereIn('status', ['open', 'active'])->with('project')->get();

        return view('admin.dashboard', compact(
            'totalFund', 'totalInvestors', 'activeBatchesCount', 'totalProfitDistributed', 'batches', 'activeBatches'
        ));
    }


    // ২. আয়-ব্যয় (P&L) এন্ট্রি করা
    public function addFinance(Request $request)
    {
        $request->validate([
            'batch_id' => 'required',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);

        // ব্যাচের আন্ডারে প্রজেক্ট না থাকলে অটোমেটিক তৈরি করে নেওয়া
        $batch = Batch::findOrFail($request->batch_id);
        $project = Project::firstOrCreate(
            ['batch_id' => $batch->id],
            ['name' => $batch->name . ' - Project', 'status' => 'running']
        );

        // আয়/ব্যয়ের হিসাব প্রজেক্টে যুক্ত করা
        ProjectFinance::create([
            'project_id' => $project->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'entry_date' => now(),
        ]);

        return back()->with('success', 'হিসাব সফলভাবে যুক্ত করা হয়েছে।');
    }

    // ৩. প্রফিট ডিস্ট্রিবিউশন লজিক
    public function distributeProfit($batch_id)
    {
        try {
            DB::beginTransaction();

            $batch = Batch::with('users', 'project')->findOrFail($batch_id);

            if (!$batch->project) {
                return back()->with('error', 'এই ব্যাচের কোনো আয়-ব্যয় এন্ট্রি করা হয়নি।');
            }

            $netProfit = $batch->project->net_profit; // Part 4-এ তৈরি করা Model Accessor

            if ($netProfit <= 0) {
                return back()->with('error', 'এই প্রজেক্টে বর্তমানে কোনো প্রফিট নেই বা লসে আছে।');
            }

            $usersCount = $batch->users->count();
            if ($usersCount == 0) {
                return back()->with('error', 'এই ব্যাচে কোনো ইনভেস্টর নেই।');
            }

            $profitPerUser = $netProfit / $usersCount;

            // Distribution রেকর্ড রাখা
            ProfitDistribution::create([
                'batch_id' => $batch->id,
                'total_profit' => $netProfit,
                'amount_per_user' => $profitPerUser,
                'distribution_date' => now(),
            ]);

            // প্রত্যেক ইউজারের ওয়ালেটে টাকা পাঠানো
            foreach ($batch->users as $user) {
                $user->wallet_balance += $profitPerUser;
                $user->save();

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'profit',
                    'amount' => $profitPerUser,
                    'description' => "{$batch->name} থেকে প্রফিট",
                    'status' => 'completed'
                ]);
            }

            // ব্যালেন্স শিট জিরো করার জন্য ডিস্ট্রিবিউট করা টাকাকে 'expense' হিসেবে দেখিয়ে দেওয়া
            ProjectFinance::create([
                'project_id' => $batch->project->id,
                'type' => 'expense',
                'amount' => $netProfit,
                'description' => 'Profit Distributed to Investors',
                'entry_date' => now(),
            ]);

            DB::commit();
            return back()->with('success', "সফলভাবে প্রফিট ডিস্ট্রিবিউট করা হয়েছে! জনপ্রতি ৳ {$profitPerUser} করে পেয়েছেন।");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'প্রফিট ডিস্ট্রিবিউশনে সমস্যা হয়েছে।');
        }
    }

    // ডিপোজিট রিকোয়েস্টগুলো দেখানোর জন্য
    public function pendingDeposits()
    {
        $deposits = Deposit::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.deposits', compact('deposits'));
    }

    // ডিপোজিট অ্যাপ্রুভ করার লজিক
    public function approveDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);

        if ($deposit->status === 'pending') {
            $deposit->status = 'approved';
            $deposit->save();

            // ইউজারের ওয়ালেটে টাকা অ্যাড করা
            $user = $deposit->user;
            $user->wallet_balance += $deposit->amount;
            $user->save();

            // ট্রানজেকশন হিস্ট্রি রেকর্ড করা
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'amount' => $deposit->amount,
                'description' => "Manual Deposit via {$deposit->payment_method} Approved",
                'status' => 'completed'
            ]);

            return back()->with('success', 'ডিপোজিট সফলভাবে অ্যাপ্রুভ করা হয়েছে এবং ইউজারের ওয়ালেটে টাকা যোগ হয়েছে।');
        }

        return back()->with('error', 'এই রিকোয়েস্ট ইতিমধ্যে প্রসেস করা হয়েছে।');
    }

    // ডিপোজিট রিজেক্ট করার লজিক
    public function rejectDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);

        if ($deposit->status === 'pending') {
            $deposit->status = 'rejected';
            $deposit->save();

            return back()->with('success', 'ডিপোজিট রিকোয়েস্ট বাতিল করা হয়েছে।');
        }

        return back()->with('error', 'এই রিকোয়েস্ট ইতিমধ্যে প্রসেস করা হয়েছে।');
    }

    // ব্যাচ ম্যানেজমেন্ট পেজ দেখানো
    public function manageBatches()
    {
        $batches = Batch::latest()->get();
        return view('admin.batches', compact('batches'));
    }

    // ব্যাচের স্ট্যাটাস আপডেট করা (Open/Active/Closed)
    public function updateBatchStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,funding,active,closed'
        ]);

        $batch = Batch::findOrFail($id);
        $batch->status = $request->status;
        $batch->save();

        return back()->with('success', 'ব্যাচের স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে।');
    }

    // নতুন ব্যাচ তৈরি করা (ইমেজ আপলোড সহ)
    public function storeBatch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'investment_amount' => 'required|numeric|min:500',
            'max_members' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('batches', 'public');
        }

        Batch::create([
            'name' => $request->name,
            'description' => $request->description,
            'investment_amount' => $request->investment_amount,
            'max_members' => $request->max_members,
            'joined_members' => 0,
            'status' => 'open',
            'image' => $imagePath // Saving image path
        ]);

        return back()->with('success', 'নতুন ব্যাচ সফলভাবে তৈরি হয়েছে।');
    }

    // ব্যাচ এডিট করা (Update)
    public function updateBatch(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'investment_amount' => 'required|numeric|min:500',
            'max_members' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // পুরনো ছবি থাকলে সেটি ডিলিট করে দেওয়া
            if ($batch->image) {
                Storage::disk('public')->delete($batch->image);
            }
            $batch->image = $request->file('image')->store('batches', 'public');
        }

        $batch->name = $request->name;
        $batch->description = $request->description;
        $batch->investment_amount = $request->investment_amount;
        $batch->max_members = $request->max_members;
        $batch->save();

        return back()->with('success', 'ব্যাচের তথ্য সফলভাবে আপডেট হয়েছে।');
    }

    // ব্যাচ ডিলিট করা (Delete)
    public function deleteBatch($id)
    {
        $batch = Batch::findOrFail($id);

        // ব্যাচের ছবি থাকলে সার্ভার থেকে ডিলিট করা
        if ($batch->image) {
            Storage::disk('public')->delete($batch->image);
        }

        $batch->delete();

        return back()->with('success', 'ব্যাচটি সফলভাবে ডিলিট করা হয়েছে।');
    }

    // ==========================================
    // প্রজেক্ট ম্যানেজমেন্ট (Project Management)
    // ==========================================

    // ১. প্রজেক্টের লিস্ট এবং ফাইন্যান্সিয়াল রিপোর্ট দেখানো
    public function manageProjects()
    {
        // প্রজেক্টের সাথে ব্যাচ এবং ফাইন্যান্স ডাটা লোড করা
        $projects = Project::with(['batch', 'finances'])->latest()->get();
        return view('admin.projects', compact('projects'));
    }


    // ২. প্রজেক্টের স্ট্যাটাস আপডেট করা (Running, Completed)
    public function updateProjectStatus(Request $request, $id)
    {
        // এখান থেকে on_hold বাদ দেওয়া হয়েছে
        $request->validate([
            'status' => 'required|in:running,completed'
        ]);

        $project = Project::findOrFail($id);
        $project->status = $request->status;
        $project->save();

        return back()->with('success', 'প্রজেক্টের স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে।');
    }

    // ==========================================
    // আয়-ব্যয় (P&L) ম্যানেজমেন্ট
    // ==========================================

    // ১. P&L পেজ এবং হিস্ট্রি দেখানো
    public function manageFinances()
    {
        // সব ফাইন্যান্স ডাটা প্রজেক্টের তথ্যসহ ফেচ করা
        $finances = ProjectFinance::with('project')->latest()->get();
        // ড্রপডাউনে দেখানোর জন্য অ্যাক্টিভ ব্যাচগুলো ফেচ করা
        $batches = Batch::whereIn('status', ['open', 'funding', 'active'])->get();

        return view('admin.finances', compact('finances', 'batches'));
    }

    // ২. ভুল এন্ট্রি ডিলিট করা
    public function deleteFinance($id)
    {
        $finance = ProjectFinance::findOrFail($id);
        $finance->delete();

        return back()->with('success', 'হিসাবটি সফলভাবে ডিলিট করা হয়েছে।');
    }

    // ==========================================
    // প্রফিট ডিস্ট্রিবিউশন পেজ ও হিস্ট্রি
    // ==========================================

    public function profitDistributions()
    {
        // অতীতের সব ডিস্ট্রিবিউশন হিস্ট্রি
        $distributions = ProfitDistribution::with('batch')->latest()->get();

        // যেসব ব্যাচের প্রজেক্ট আছে এবং নিট প্রফিট > ০, শুধুমাত্র সেগুলো ফেচ করা
        $eligibleBatches = Batch::whereIn('status', ['active', 'completed'])
            ->with('project')
            ->get()
            ->filter(function ($batch) {
                return $batch->project && $batch->project->net_profit > 0;
            });

        return view('admin.profit_distributions', compact('distributions', 'eligibleBatches'));
    }

    // ==========================================
    // ইউজার ম্যানেজমেন্ট (User Management)
    // ==========================================

    // ১. সব ইউজারের লিস্ট দেখানো
    public function manageUsers()
    {
        // ইউজারদের লিস্ট এবং তারা কয়টি ব্যাচে জয়েন করেছে তা ফেচ করা
        $users = User::withCount('batches')->latest()->get();
        return view('admin.users', compact('users'));
    }

// ২. ইউজারের তথ্য (নাম, ইমেইল, পাসওয়ার্ড, রোল) আপডেট করা
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6', // পাসওয়ার্ড দিলে আপডেট হবে, না দিলে আগেরটাই থাকবে
            'role' => 'required|in:admin,investor'
        ]);

        // নিজের রোল যেন নিজে পরিবর্তন করতে না পারে
        if (auth()->id() == $id && $request->role != 'admin') {
            return back()->with('error', 'আপনি নিজের অ্যাডমিন রোল পরিবর্তন করতে পারবেন না!');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // যদি নতুন পাসওয়ার্ড দেয়, তাহলে সেটি হ্যাশ করে সেভ করবে
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'ইউজারের তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    // উইথড্র রিকোয়েস্টগুলো দেখানোর জন্য
    public function pendingWithdrawals()
    {
        $withdrawals = Withdrawal::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.withdrawals', compact('withdrawals'));
    }

    // উইথড্র অ্যাপ্রুভ করা
    public function approveWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($withdrawal->status === 'pending') {
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // ট্রানজেকশন হিস্ট্রি রেকর্ড করা (ব্যালেন্স আগেই কাটা হয়েছে)
            Transaction::create([
                'user_id' => $withdrawal->user_id,
                'type' => 'withdraw',
                'amount' => $withdrawal->amount,
                'description' => "Withdrawal Approved via {$withdrawal->payment_method}",
                'status' => 'completed'
            ]);

            return back()->with('success', 'উইথড্র সফলভাবে অ্যাপ্রুভ করা হয়েছে।');
        }
        return back()->with('error', 'এই রিকোয়েস্ট ইতিমধ্যে প্রসেস করা হয়েছে।');
    }

    // উইথড্র রিজেক্ট করা (রিজেক্ট করলে টাকা আবার ওয়ালেটে ফেরত যাবে)
    public function rejectWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($withdrawal->status === 'pending') {
            $withdrawal->status = 'rejected';
            $withdrawal->save();

            // ইউজারের ওয়ালেটে টাকা ফেরত (Refund) দেওয়া
            $user = $withdrawal->user;
            $user->wallet_balance += $withdrawal->amount;
            $user->save();

            return back()->with('success', 'রিকোয়েস্ট বাতিল করা হয়েছে এবং ইউজারের ব্যালেন্স রিফান্ড করা হয়েছে।');
        }
        return back()->with('error', 'এই রিকোয়েস্ট ইতিমধ্যে প্রসেস করা হয়েছে।');
    }

    // সাইট সেটিংস পেজ লোড করা
    public function siteSettings()
    {
        // ডাটাবেস থেকে সব সেটিংস এনে 'key' অনুযায়ী সাজানো
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.site_settings', compact('settings'));
    }

// সাইট সেটিংস সেভ বা আপডেট করা (ইমেজ আপলোড সহ)
    public function updateSiteSettings(Request $request)
    {
        $data = $request->except(['_token']);
        
        foreach ($data as $key => $value) {
            // যদি ইনপুটটি কোনো ফাইল/ইমেজ হয়
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('settings', 'public'); // storage/app/public/settings ফোল্ডারে সেভ হবে
                
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            } 
            // যদি ইনপুটটি সাধারণ টেক্সট হয়
            elseif ($value !== null) {
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return back()->with('success', 'সাইটের সেটিংস এবং ছবি সফলভাবে আপডেট করা হয়েছে।');
    }

    // টেস্টিমোনিয়াল পেজ লোড করা
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials', compact('testimonials'));
    }

    // নতুন টেস্টিমোনিয়াল সেভ করা
    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'role' => 'required',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($data);
        return back()->with('success', 'টেস্টিমোনিয়াল সফলভাবে যুক্ত হয়েছে!');
    }

    // টেস্টিমোনিয়াল ডিলিট করা
    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return back()->with('success', 'টেস্টিমোনিয়াল ডিলিট করা হয়েছে!');
    }
}
