<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    // ইউজারের জন্য ড্যাশবোর্ড এবং রানিং ব্যাচগুলো দেখানো
    public function index()
    {
        $user = Auth::user();
        $openBatches = Batch::whereIn('status', ['open', 'funding'])->get();
        $myBatches = $user->batches; // User's active batches

        return view('dashboard.index', compact('user', 'openBatches', 'myBatches'));
    }

    // ব্যাচে জয়েন করার Core Logic (Locking & Concurrency)
    public function joinBatch(Request $request, $id)
    {
        $user = Auth::user();

        // 1. Database Transaction শুরু (Pessimistic Locking এর জন্য)
        try {
            DB::beginTransaction();

            // 2. ব্যাচটিকে lockForUpdate() দিয়ে সিলেক্ট করা হলো, 
            // যাতে অন্য কোনো ইউজার একই সময়ে এই রো আপডেট করতে না পারে।
            $batch = Batch::where('id', $id)->lockForUpdate()->firstOrFail();

            // 3. চেক করা: ব্যাচে ২৫ জন পূর্ণ হয়ে গেছে কি না?
            if ($batch->joined_members >= $batch->max_members) {
                DB::rollBack();
                return back()->with('error', 'দুঃখিত! এই ব্যাচটি সম্পূর্ণ ভর্তি হয়ে গেছে (২৫/২৫)।');
            }

            // 4. চেক করা: ইউজার আগে থেকেই এই ব্যাচে জয়েন করেছে কি না?
            if ($user->batches()->where('batch_id', $batch->id)->exists()) {
                DB::rollBack();
                return back()->with('error', 'আপনি ইতিমধ্যে এই ব্যাচে যুক্ত আছেন।');
            }

            // 5. চেক করা: ইউজারের ওয়ালেটে পর্যাপ্ত টাকা আছে কি না?
            if ($user->wallet_balance < $batch->investment_amount) {
                DB::rollBack();
                return back()->with('error', 'আপনার ওয়ালেটে পর্যাপ্ত ব্যালেন্স নেই। দয়া করে ফান্ড যোগ করুন।');
            }

            // 6. ইউজারের ব্যালেন্স কাটা হলো
            $user->wallet_balance -= $batch->investment_amount;
            $user->save();

            // 7. Pivot টেবিলে (batch_user) ইউজারকে যুক্ত করা হলো
            $batch->users()->attach($user->id, [
                'invested_amount' => $batch->investment_amount,
                'status' => 'active'
            ]);

            // 8. ব্যাচের joined_members কাউন্ট বাড়ানো হলো
            $batch->joined_members += 1;

            // 9. যদি ২৫ জন পূর্ণ হয়ে যায়, ব্যাচের স্ট্যাটাস 'active' বা 'funding' এ পরিবর্তন করা
            if ($batch->joined_members == $batch->max_members) {
                $batch->status = 'active'; // Lock the batch
            }
            $batch->save();

            // 10. ট্রানজেকশন হিস্ট্রি রেকর্ড করা
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'investment',
                'amount' => $batch->investment_amount,
                'description' => "Invested in {$batch->name}",
                'status' => 'completed'
            ]);

            // 11. সবকিছু ঠিক থাকলে Commit করা (লক রিলিজ হয়ে যাবে)
            DB::commit();

            return back()->with('success', 'অভিনন্দন! আপনি সফলভাবে ব্যাচে জয়েন করেছেন।');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'কোথাও কোনো সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }

    // ইউজারের "আমার ব্যাচসমূহ" পেজ লোড করা
    public function myBatches()
    {
        $user = Auth::user();
        
        // ইউজারের নিজের জয়েন করা ব্যাচগুলো (প্রজেক্টের তথ্যসহ)
        $myBatches = $user->batches()->with('project')->latest()->get();
        
        // ইউজারের জয়েন করা ব্যাচগুলোর আইডি আলাদা করা
        $myBatchIds = $myBatches->pluck('id')->toArray();
        
        // যেসব ব্যাচে ইউজার এখনো জয়েন করেনি এবং ব্যাচটি 'open' আছে
        $availableBatches = Batch::where('status', 'open')
                                 ->whereNotIn('id', $myBatchIds)
                                 ->latest()
                                 ->get();

        return view('dashboard.batches', compact('myBatches', 'availableBatches'));
    }
}