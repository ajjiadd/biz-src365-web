@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 font-bold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 font-bold">{{ session('error') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-brand-black">প্রফিট ডিস্ট্রিবিউশন</h2>
            <p class="text-gray-500 text-sm mt-1">বিনিয়োগকারীদের মাঝে প্রফিট বন্টন করুন এবং পূর্বের হিস্ট্রি দেখুন।</p>
        </div>
        <button onclick="document.getElementById('distributeModal').classList.remove('hidden')" class="bg-brand-red text-brand-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 transition shadow">
            💸 নতুন প্রফিট দিন
        </button>
    </div>

    <!-- ডিস্ট্রিবিউশন হিস্ট্রি (History) -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">তারিখ</th>
                    <th class="p-4 border-b">ব্যাচের নাম</th>
                    <th class="p-4 border-b">মোট বন্টনকৃত প্রফিট</th>
                    <th class="p-4 border-b">জনপ্রতি পেয়েছে</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distributions as $distribution)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($distribution->distribution_date)->format('d M, Y h:i A') }}
                    </td>
                    <td class="p-4 border-b font-bold text-brand-black">
                        {{ $distribution->batch->name ?? 'N/A' }}
                    </td>
                    <td class="p-4 border-b font-bold text-green-600">
                        ৳ {{ number_format($distribution->total_profit) }}
                    </td>
                    <td class="p-4 border-b font-bold text-brand-red">
                        ৳ {{ number_format($distribution->amount_per_user) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        এখনো কোনো প্রফিট ডিস্ট্রিবিউট করা হয়নি।
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Distribute Profit Modal -->
    <div id="distributeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
        <div class="bg-white rounded-lg p-8 max-w-lg w-full relative">
            <button onclick="document.getElementById('distributeModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-6 text-brand-black flex items-center">
                <span class="w-2 h-6 bg-brand-red mr-2 rounded"></span> প্রফিট ডিস্ট্রিবিউট করুন
            </h2>
            
            @if($eligibleBatches->count() > 0)
                <p class="text-sm text-gray-600 mb-4">নিচের ব্যাচগুলোতে বর্তমানে প্রফিট রয়েছে। ব্যাচ সিলেক্ট করে "ডিস্ট্রিবিউট করুন" বাটনে ক্লিক করলে সিস্টেম অটোমেটিক প্রফিট হিসাব করে মেম্বারদের ওয়ালেটে পাঠিয়ে দেবে।</p>
                
                <div class="space-y-4">
                    @foreach($eligibleBatches as $batch)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 flex justify-between items-center hover:border-brand-red transition">
                            <div>
                                <h4 class="font-bold text-brand-black">{{ $batch->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">বর্তমান নিট প্রফিট: <span class="font-bold text-green-600">৳ {{ number_format($batch->project->net_profit) }}</span></p>
                                <p class="text-xs text-gray-500">মেম্বার: {{ $batch->joined_members }} জন</p>
                            </div>
                            <form action="{{ route('admin.profit.distribute', $batch->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত? এই প্রসেসটি অটোমেটিক্যালি সবার ওয়ালেটে টাকা পাঠিয়ে দিবে এবং এটি বাতিল করা যাবে না।');">
                                @csrf
                                <button type="submit" class="bg-brand-red text-white text-xs px-4 py-2 font-bold rounded hover:bg-red-700 transition shadow">বন্টন করুন</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <p class="text-gray-500 font-bold mb-2">দুঃখিত!</p>
                    <p class="text-sm text-gray-500">বর্তমানে প্রফিট দেওয়ার মতো কোনো ব্যাচ নেই। প্রজেক্টে আয় যুক্ত হলে এখানে ব্যাচগুলো দেখা যাবে।</p>
                </div>
            @endif
        </div>
    </div>
@endsection