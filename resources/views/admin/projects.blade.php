@extends('layouts.admin')

@section('content')
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 font-bold">{{ session('success') }}</div>
@endif

<div class="mb-6">
    <h2 class="text-2xl font-bold text-brand-black">প্রজেক্ট ম্যানেজমেন্ট</h2>
    <p class="text-gray-500 text-sm mt-1">সবগুলো রানিং প্রজেক্টের আর্থিক অবস্থা এবং আয়-ব্যয়ের বিস্তারিত রিপোর্ট।</p>
</div>

<!-- প্রজেক্টের তালিকা -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-brand-black text-brand-white">
                <th class="p-4 border-b">প্রজেক্ট ও ব্যাচ</th>
                <th class="p-4 border-b">মোট আয়</th>
                <th class="p-4 border-b">মোট ব্যয়</th>
                <th class="p-4 border-b">নিট প্রফিট</th>
                <th class="p-4 border-b">স্ট্যাটাস</th>
                <th class="p-4 border-b text-right">বিস্তারিত</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)

            @php
            // প্রজেক্টের আয়, ব্যয় ও প্রফিট হিসাব করা
            $totalIncome = $project->finances->where('type', 'income')->sum('amount');
            $totalExpense = $project->finances->where('type', 'expense')->sum('amount');
            $netProfit = $totalIncome - $totalExpense;
            @endphp

            <tr class="hover:bg-gray-50 border-b border-gray-100">
                <td class="p-4">
                    <span class="font-bold text-brand-black block">{{ $project->name }}</span>
                    <span class="text-xs text-gray-500">ব্যাচ: {{ $project->batch->name ?? 'N/A' }}</span>
                </td>
                <td class="p-4 font-bold text-green-600">৳ {{ number_format($totalIncome) }}</td>
                <td class="p-4 font-bold text-brand-red">৳ {{ number_format($totalExpense) }}</td>
                <td class="p-4 font-bold {{ $netProfit >= 0 ? 'text-green-600' : 'text-brand-red' }}">
                    {{ $netProfit >= 0 ? '+' : '' }} ৳ {{ number_format($netProfit) }}
                </td>
                <td class="p-4">
                    <form action="{{ route('admin.projects.status', $project->id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded p-1.5 text-sm focus:outline-none focus:border-brand-red cursor-pointer">
                            <option value="running" {{ $project->status == 'running' ? 'selected' : '' }}>Running</option>
                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </td>
                <td class="p-4 text-right">
                    <!-- History Button -->
                    <button onclick="document.getElementById('financeHistoryModal{{ $project->id }}').classList.remove('hidden')" class="bg-gray-200 text-gray-800 px-3 py-1.5 rounded text-sm font-bold hover:bg-gray-300 transition">হিস্ট্রি দেখুন</button>
                </td>
            </tr>

            <!-- Finance History Modal for this specific project -->
            <div id="financeHistoryModal{{ $project->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
                <div class="bg-white rounded-lg p-6 max-w-2xl w-full relative">
                    <button onclick="document.getElementById('financeHistoryModal{{ $project->id }}').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
                    <h2 class="text-xl font-bold mb-4 text-brand-black">{{ $project->name }} - আয়-ব্যয়ের হিস্ট্রি</h2>

                    <div class="max-h-80 overflow-y-auto pr-2 border-t border-gray-200 pt-4">
                        @forelse($project->finances()->latest()->get() as $finance)
                        <div class="flex justify-between items-center border-b border-gray-100 last:border-0 py-3">
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">{{ $finance->description }}</h4>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($finance->entry_date)->format('d M, Y') }}</p>
                            </div>
                            <span class="text-sm font-bold px-3 py-1 rounded {{ $finance->type == 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-brand-red' }}">
                                {{ $finance->type == 'income' ? '+' : '-' }} ৳ {{ number_format($finance->amount) }}
                            </span>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4 text-sm">এই প্রজেক্টে এখনো কোনো আয় বা ব্যয়ের হিসাব যুক্ত করা হয়নি।</p>
                        @endforelse
                    </div>
                </div>
            </div>

            @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-500">
                    <p class="text-lg mb-2">কোনো প্রজেক্ট পাওয়া যায়নি!</p>
                    <p class="text-sm">অ্যাডমিন ড্যাশবোর্ড থেকে "আয়-ব্যয় এন্ট্রি" করলে স্বয়ংক্রিয়ভাবে প্রজেক্ট তৈরি হয়ে যাবে।</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection