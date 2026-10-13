<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\ProjectFinance;
use Illuminate\Support\Facades\Auth;
use App\Models\Deposit;
use Illuminate\Support\Facades\DB;
use App\Models\Withdrawal;

class WalletController extends Controller
{
    // ১. ফান্ড অ্যাড (Deposit) রিকোয়েস্ট সাবমিট করা
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:500',
            'payment_method' => 'required|string',
            'sender_account_info' => 'required|string',
        ]);

        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'sender_account_info' => $request->sender_account_info,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending'
        ]);

        return back()->with('success', "আপনার ফান্ড রিকোয়েস্ট সফলভাবে জমা হয়েছে। অ্যাডমিন চেক করে অ্যাপ্রুভ করলে আপনার ওয়ালেটে টাকা যোগ হবে।");
    }

    // ২. উইথড্র (Withdraw) রিকোয়েস্ট সাবমিট করার লজিক
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:500',
            'payment_method' => 'required|string',
            'account_details' => 'required|string',
        ]);

        $user = Auth::user();

        // চেক করা: ইউজারের ওয়ালেটে পর্যাপ্ত টাকা আছে কি না
        if ($user->wallet_balance < $request->amount) {
            return back()->with('error', 'আপনার ওয়ালেটে পর্যাপ্ত ব্যালেন্স নেই!');
        }

        // রিকোয়েস্ট করার সাথে সাথেই ইউজারের ব্যালেন্স কেটে নেওয়া হলো (যাতে সে ডাবল খরচ করতে না পারে)
        $user->wallet_balance -= $request->amount;
        $user->save();

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'account_details' => $request->account_details,
            'status' => 'pending'
        ]);

        return back()->with('success', "আপনার উইথড্র রিকোয়েস্ট সফলভাবে জমা হয়েছে। অ্যাডমিন চেক করে টাকা পাঠিয়ে দিবে।");
    }

    // ৩. ইউজারের ওয়ালেট, লেনদেন এবং গ্রাফ রিপোর্ট লোড করা
    public function myWallet()
    {
        $user = Auth::user();

        // ১. ইউজারের ব্যক্তিগত ট্রানজেকশন হিস্ট্রি (Deposit, Withdraw, Profit)
        $transactions = Transaction::where('user_id', $user->id)->latest()->get();

        // ২. ইউজার যেসব ব্যাচে জয়েন করেছে সেগুলোর আইডি বের করা
        $myBatchIds = $user->batches()->pluck('batches.id');

        // ৩. ইউজারের ব্যাচগুলোর প্রজেক্টের আয়-ব্যয় হিস্ট্রি (স্বচ্ছতার জন্য)
        $projectFinances = ProjectFinance::with(['project.batch'])
            ->whereHas('project', function($query) use ($myBatchIds) {
                $query->whereIn('batch_id', $myBatchIds);
            })->latest()->get();

        // ৪. গ্রাফের জন্য ডাটা প্রস্তুত করা (Chart.js Data)
        // যেসব তারিখে আয় বা ব্যয় হয়েছে, এমন ইউনিক তারিখগুলো বের করা
        $recentDates = ProjectFinance::whereHas('project', function($query) use ($myBatchIds) {
                $query->whereIn('batch_id', $myBatchIds);
            })
            ->selectRaw('DATE(entry_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(10)
            ->pluck('date')
            ->toArray();

        $dates = [];
        $incomes = [];
        $expenses = [];

        foreach ($recentDates as $date) {
            $dates[] = \Carbon\Carbon::parse($date)->format('d M'); // Ex: 12 Oct
            
            // ঐ দিনের মোট আয়
            $incomes[] = ProjectFinance::whereHas('project', function($query) use ($myBatchIds) {
                $query->whereIn('batch_id', $myBatchIds);
            })->whereDate('entry_date', $date)->where('type', 'income')->sum('amount');
            
            // ঐ দিনের মোট ব্যয়
            $expenses[] = ProjectFinance::whereHas('project', function($query) use ($myBatchIds) {
                $query->whereIn('batch_id', $myBatchIds);
            })->whereDate('entry_date', $date)->where('type', 'expense')->sum('amount');
        }

        return view('dashboard.wallet', compact('user', 'transactions', 'projectFinances', 'dates', 'incomes', 'expenses'));
    }
}