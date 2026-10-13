@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-bold">{{ session('success') }}</div>
    @endif

    <h2 class="text-2xl font-bold mb-6">পেন্ডিং উইথড্র রিকোয়েস্ট</h2>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 border-b">ইউজার</th>
                    <th class="p-4 border-b">পরিমাণ</th>
                    <th class="p-4 border-b">মেথড</th>
                    <th class="p-4 border-b">পেমেন্ট ডিটেইলস</th>
                    <th class="p-4 border-b">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $withdraw)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">{{ $withdraw->user->name }}</td>
                    <td class="p-4 border-b font-bold text-brand-red">৳ {{ number_format($withdraw->amount) }}</td>
                    <td class="p-4 border-b capitalize">{{ $withdraw->payment_method }}</td>
                    <td class="p-4 border-b text-sm text-gray-600">{{ $withdraw->account_details }}</td>
                    <td class="p-4 border-b flex space-x-2">
                        <form action="{{ route('admin.withdrawal.approve', $withdraw->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 font-bold">Approve</button>
                        </form>
                        <form action="{{ route('admin.withdrawal.reject', $withdraw->id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 font-bold">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-4 text-center text-gray-500">কোনো উইথড্র রিকোয়েস্ট নেই।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection