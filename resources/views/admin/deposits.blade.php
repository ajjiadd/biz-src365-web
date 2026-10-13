@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <h2 class="text-2xl font-bold mb-6">পেন্ডিং ডিপোজিট রিকোয়েস্ট</h2>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">ইউজার</th>
                    <th class="p-4 border-b">পরিমাণ</th>
                    <th class="p-4 border-b">পেমেন্ট মেথড</th>
                    <th class="p-4 border-b">অ্যাকাউন্ট ইনফো / TxnID</th>
                    <th class="p-4 border-b">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deposits as $deposit)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">{{ $deposit->user->name }} ({{ $deposit->user->email }})</td>
                    <td class="p-4 border-b font-bold text-green-600">৳ {{ number_format($deposit->amount) }}</td>
                    <td class="p-4 border-b capitalize">{{ $deposit->payment_method }}</td>
                    <td class="p-4 border-b">
                        <span class="block text-sm">From: {{ $deposit->sender_account_info }}</span>
                        <span class="block text-xs text-gray-500">TxnID: {{ $deposit->transaction_id ?? 'N/A' }}</span>
                    </td>
                    <td class="p-4 border-b flex space-x-2">
                        <form action="{{ route('admin.deposit.approve', $deposit->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">Approve</button>
                        </form>
                        <form action="{{ route('admin.deposit.reject', $deposit->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">কোনো পেন্ডিং রিকোয়েস্ট নেই।</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection