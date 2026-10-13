@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-brand-black">আয়-ব্যয় (P&L) এন্ট্রি</h2>
            <p class="text-gray-500 text-sm mt-1">প্রজেক্টের প্রতিদিনের ইনকাম বা এক্সপেন্স এন্ট্রি করুন এবং হিস্ট্রি দেখুন।</p>
        </div>
        <button onclick="document.getElementById('addFinanceModal').classList.remove('hidden')" class="bg-brand-black text-brand-white px-4 py-2 rounded-lg font-bold hover:bg-brand-red transition">
            + নতুন এন্ট্রি
        </button>
    </div>

    <!-- আয়-ব্যয়ের তালিকা (History) -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">তারিখ</th>
                    <th class="p-4 border-b">প্রজেক্টের নাম</th>
                    <th class="p-4 border-b">বিবরণ</th>
                    <th class="p-4 border-b">ধরণ</th>
                    <th class="p-4 border-b">পরিমাণ</th>
                    <th class="p-4 border-b text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finances as $finance)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($finance->entry_date)->format('d M, Y') }}
                    </td>
                    <td class="p-4 border-b">
                        <span class="font-bold text-brand-black text-sm">{{ $finance->project->name ?? 'N/A' }}</span>
                    </td>
                    <td class="p-4 border-b text-sm text-gray-600">
                        {{ $finance->description }}
                    </td>
                    <td class="p-4 border-b">
                        @if($finance->type == 'income')
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded uppercase">Income</span>
                        @else
                            <span class="bg-red-100 text-brand-red text-xs font-bold px-2 py-1 rounded uppercase">Expense</span>
                        @endif
                    </td>
                    <td class="p-4 border-b font-bold {{ $finance->type == 'income' ? 'text-green-600' : 'text-brand-red' }}">
                        {{ $finance->type == 'income' ? '+' : '-' }} ৳ {{ number_format($finance->amount) }}
                    </td>
                    <td class="p-4 border-b text-right">
                        <!-- Delete Button -->
                        <form action="{{ route('admin.finance.delete', $finance->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই হিসাবটি ডিলিট করতে চান? এটি প্রজেক্টের মোট লাভে প্রভাব ফেলবে।');">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-sm font-bold hover:bg-red-600 transition">ডিলিট</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        কোনো আয়-ব্যয়ের হিসাব পাওয়া যায়নি।
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Finance Modal -->
    <div id="addFinanceModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
        <div class="bg-white rounded-lg p-8 max-w-lg w-full relative">
            <button onclick="document.getElementById('addFinanceModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-6 text-brand-black flex items-center">
                <span class="w-2 h-6 bg-brand-red mr-2 rounded"></span> নতুন আয়-ব্যয় এন্ট্রি
            </h2>
            
            <form action="{{ route('admin.finance.add') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-brand-black mb-1">ব্যাচ/প্রজেক্ট নির্বাচন করুন</label>
                    <select name="batch_id" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                        <option value="">নির্বাচন করুন...</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }} (Status: {{ ucfirst($batch->status) }})</option>
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
                <button type="submit" class="w-full bg-brand-black text-brand-white font-bold py-3 rounded-lg hover:bg-brand-red transition duration-300 mt-4">
                    হিসাব সেভ করুন
                </button>
            </form>
        </div>
    </div>
@endsection