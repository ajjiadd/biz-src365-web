@extends('layouts.admin')

@section('content')
    <!-- Alerts -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 font-bold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 font-bold">{{ session('error') }}</div>
    @endif

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-brand-black">অ্যাডমিন ওভারভিউ</h1>
        <p class="text-gray-500 text-sm mt-1">পুরো সিস্টেমের সার্বিক অবস্থা এবং প্রজেক্টের লাভ-ক্ষতির হিসাব একনজরে।</p>
    </div>

    <!-- 1. Global Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-brand-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-xs font-bold uppercase mb-1">মোট ফান্ড সংগ্রহ</p>
            <h3 class="text-2xl font-bold text-brand-black">৳ {{ number_format($totalFund) }}</h3>
        </div>
        <div class="bg-brand-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-xs font-bold uppercase mb-1">মোট বিনিয়োগকারী</p>
            <h3 class="text-2xl font-bold text-brand-black">{{ $totalInvestors }} জন</h3>
        </div>
        <div class="bg-brand-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-brand-red">
            <p class="text-gray-500 text-xs font-bold uppercase mb-1">সক্রিয় ব্যাচ</p>
            <h3 class="text-2xl font-bold text-brand-black">{{ $activeBatchesCount }} টি</h3>
        </div>
        <div class="bg-brand-black p-6 rounded-xl shadow-sm text-brand-white">
            <p class="text-gray-400 text-xs font-bold uppercase mb-1">মোট মুনাফা বন্টন</p>
            <h3 class="text-2xl font-bold text-brand-red">৳ {{ number_format($totalProfitDistributed) }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- 2. P&L Quick Entry Form -->
        <div class="bg-brand-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-brand-black mb-4 flex items-center">
                <span class="w-2 h-6 bg-brand-red mr-2 rounded"></span> দৈনন্দিন আয়-ব্যয় এন্ট্রি
            </h3>
            
            <form action="{{ route('admin.finance.add') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-brand-black mb-1">ব্যাচ/প্রজেক্ট নির্বাচন করুন</label>
                    <select name="batch_id" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                        <option value="">নির্বাচন করুন...</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }} (Status: {{ $batch->status }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">এন্ট্রির ধরন</label>
                        <select name="type" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                            <option value="income">আয় (Income)</option>
                            <option value="expense">ব্যয় (Expense)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">পরিমাণ (৳)</label>
                        <input type="number" name="amount" required placeholder="যেমন: 5000" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-brand-black mb-1">বিবরণ</label>
                    <input type="text" name="description" required placeholder="যেমন: আজকের বাসের টিকেট বিক্রি" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                </div>
                <button type="submit" class="w-full bg-brand-black text-brand-white font-bold py-3 rounded-lg hover:bg-brand-red transition duration-300 mt-2">
                    হিসাব সেভ করুন
                </button>
            </form>
        </div>

        <!-- 3. Active Batches Status & Profit Distribution -->
        <div class="bg-brand-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-brand-black mb-4 flex items-center">
                <span class="w-2 h-6 bg-brand-black mr-2 rounded"></span> ব্যাচ স্ট্যাটাস ও প্রফিট
            </h3>
            
            <div class="space-y-4 overflow-y-auto max-h-[400px] pr-2">
                @foreach($activeBatches as $batch)
                <div class="border border-gray-100 rounded-lg p-4 bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h4 class="font-bold text-brand-black text-sm">{{ $batch->name }}</h4>
                            <p class="text-xs text-gray-500">সংগৃহীত ফান্ড: ৳ {{ number_format($batch->joined_members * $batch->investment_amount) }}</p>
                        </div>
                        <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded uppercase">{{ $batch->status }}</span>
                    </div>
                    
                    @php $netProfit = $batch->project ? $batch->project->net_profit : 0; @endphp
                    
                    <div class="flex justify-between text-xs mb-3 pb-2 border-b border-gray-200">
                        <span class="text-gray-500">বর্তমান প্রফিট/লস:</span>
                        <span class="font-bold {{ $netProfit >= 0 ? 'text-green-600' : 'text-brand-red' }}">
                            {{ $netProfit >= 0 ? '+' : '' }} ৳ {{ number_format($netProfit) }}
                        </span>
                    </div>
                    
                    @if($netProfit > 0)
                        <form action="{{ route('admin.profit.distribute', $batch->id) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('আপনি কি নিশ্চিত যে এই প্রফিট মেম্বারদের মাঝে ভাগ করে দিতে চান?');" class="w-full text-xs font-bold text-brand-red border border-brand-red py-2 rounded hover:bg-brand-red hover:text-white transition">প্রফিট ডিস্ট্রিবিউট করুন</button>
                        </form>
                    @else
                        <button disabled class="w-full text-xs font-bold text-gray-400 bg-gray-200 py-2 rounded cursor-not-allowed">প্রফিট ডিস্ট্রিবিউট করার মতো ব্যালেন্স নেই</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection