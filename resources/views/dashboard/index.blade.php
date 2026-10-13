@extends('layouts.dashboard')

@section('content')
<!-- Flash Messages (Success/Error) -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 font-bold">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 font-bold">
    {{ session('error') }}
</div>
@endif

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-brand-black">স্বাগতম, {{ $user->name }}! 👋</h1>
        <p class="text-gray-500 text-sm mt-1">আপনার পোর্টফোলিও এবং বিনিয়োগের বর্তমান অবস্থা এখানে দেখতে পাবেন।</p>
    </div>
</div>

<!-- 1. Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Wallet Balance Card -->
    <!-- Wallet Balance Card -->
    <div class="bg-brand-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
        <div class="absolute right-0 top-0 w-24 h-24 bg-brand-red/5 rounded-bl-full -z-0"></div>
        <p class="text-gray-500 text-sm font-semibold mb-1">বর্তমান ওয়ালেট ব্যালেন্স</p>
        <h3 class="text-3xl font-bold text-brand-black mb-4">৳ {{ number_format($user->wallet_balance, 2) }}</h3>

        <div class="flex space-x-3 relative z-10 mt-4">
            <!-- New Fund Add Button (Opens Modal) -->
            <button onclick="document.getElementById('depositModal').classList.remove('hidden')" class="bg-brand-black text-brand-white text-xs px-4 py-2 rounded-lg font-bold hover:bg-gray-800 transition shadow">
                ফান্ড অ্যাড
            </button>
        </div>
    </div>

    <!-- Deposit Modal -->
    <div id="depositModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full relative">
            <button onclick="document.getElementById('depositModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500">&times;</button>
            <h2 class="text-2xl font-bold mb-4">ফান্ড যোগ করুন</h2>

            <!-- Admin Bank Info -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                <h4 class="font-bold text-sm mb-2 text-brand-red">আমাদের পেমেন্ট ইনফরমেশন:</h4>
                <p class="text-sm"><strong>বিকাশ (Personal):</strong> 017XXXXXXXX</p>
                <p class="text-sm"><strong>নগদ (Personal):</strong> 017XXXXXXXX</p>
                <p class="text-sm mt-2"><strong>Bank:</strong> DBBL (Dutch Bangla Bank)<br><strong>A/C Name:</strong> SOURCE 365<br><strong>A/C No:</strong> 123.456.78901</p>
            </div>

            <!-- User Deposit Form -->
            <form action="{{ route('wallet.deposit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold mb-1">পরিমাণ (৳)</label>
                    <input type="number" name="amount" required class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">পেমেন্ট মেথড</label>
                    <select name="payment_method" required class="w-full border p-2 rounded">
                        <option value="bkash">বিকাশ</option>
                        <option value="nagad">নগদ</option>
                        <option value="bank">ব্যাংক ট্রান্সফার</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">যেই নাম্বার/অ্যাকাউন্ট থেকে পাঠিয়েছেন</label>
                    <input type="text" name="sender_account_info" required placeholder="Ex: 017XXXXXX or Bank A/C Name" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">ট্রানজেকশন আইডি (TxnID)</label>
                    <input type="text" name="transaction_id" placeholder="Optional for Bank" class="w-full border p-2 rounded">
                </div>
                <button type="submit" class="w-full bg-brand-red text-white font-bold py-2 rounded mt-4">রিকোয়েস্ট সাবমিট করুন</button>
            </form>
        </div>
    </div>

    <!-- Total Invested Card -->
    <div class="bg-brand-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-gray-500 text-sm font-semibold mb-1">মোট বিনিয়োগ</p>
        @php $totalInvested = $myBatches->sum('pivot.invested_amount'); @endphp
        <h3 class="text-3xl font-bold text-brand-black mb-4">৳ {{ number_format($totalInvested, 2) }}</h3>
        <p class="text-xs text-gray-500"><span class="text-brand-red font-bold">{{ $myBatches->count() }}টি</span> সক্রিয় ব্যাচে আপনার বিনিয়োগ রয়েছে</p>
    </div>

    <!-- Total Profit Card -->
    <div class="bg-brand-white p-6 rounded-2xl border border-gray-100 shadow-sm border-b-4 border-b-brand-red">
        <p class="text-gray-500 text-sm font-semibold mb-1">মোট অর্জিত মুনাফা</p>
        @php $totalProfit = $user->transactions->where('type', 'profit')->sum('amount'); @endphp
        <h3 class="text-3xl font-bold text-brand-red mb-4">৳ {{ number_format($totalProfit, 2) }}</h3>
        <p class="text-xs text-gray-500">বিনিয়োগ থেকে আপনার সর্বমোট আয়</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- 2. My Active Batches -->
    <div class="lg:col-span-2">
        <div class="bg-brand-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-brand-black">আমার বিনিয়োগকৃত ব্যাচসমূহ</h3>
            </div>

            <div class="space-y-4">
                @forelse($myBatches as $batch)
                <div class="border border-gray-100 rounded-xl p-4 flex flex-col md:flex-row justify-between items-center hover:border-brand-red/30 transition bg-gray-50">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div>
                            <h4 class="font-bold text-brand-black">{{ $batch->name }}</h4>
                            <p class="text-xs text-gray-500 mt-1">
                                বিনিয়োগ: ৳ {{ number_format($batch->pivot->invested_amount) }} &bull;
                                স্ট্যাটাস: <span class="text-green-600 font-bold uppercase">{{ $batch->status }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <p class="text-gray-500 text-sm mb-3">আপনি এখনো কোনো ব্যাচে বিনিয়োগ করেননি।</p>
                    <a href="/#batches" class="inline-block bg-brand-red text-white text-sm font-bold px-6 py-2 rounded-full hover:bg-red-700 transition">নতুন ব্যাচগুলো দেখুন</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 3. Recent Transactions -->
    <div class="lg:col-span-1">
        <div class="bg-brand-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-bold text-brand-black mb-6">সাম্প্রতিক লেনদেন</h3>

            <div class="space-y-5 max-h-80 overflow-y-auto pr-2">
                @forelse($user->transactions()->latest()->take(5)->get() as $transaction)
                <div class="flex justify-between items-center border-b border-gray-100 last:border-0 pb-3 last:pb-0">
                    <div class="flex items-center">
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit')
                        <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-sm mr-3">↓</div>
                        @else
                        <div class="w-8 h-8 bg-brand-red/10 text-brand-red rounded-full flex items-center justify-center font-bold text-sm mr-3">↑</div>
                        @endif

                        <div>
                            <h4 class="text-sm font-bold text-brand-black capitalize">{{ str_replace('_', ' ', $transaction->type) }}</h4>
                            <p class="text-xs text-gray-400">{{ $transaction->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    <span class="text-sm font-bold {{ ($transaction->type == 'deposit' || $transaction->type == 'profit') ? 'text-green-600' : 'text-brand-red' }}">
                        {{ ($transaction->type == 'deposit' || $transaction->type == 'profit') ? '+' : '-' }} ৳ {{ number_format($transaction->amount) }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-xs text-center py-4">কোনো লেনদেন পাওয়া যায়নি।</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection