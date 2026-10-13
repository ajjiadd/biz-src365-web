@extends('layouts.dashboard')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-8">
    <h2 class="text-3xl font-bold text-brand-black">ওয়ালেট ও লেনদেন 💰</h2>
    <p class="text-gray-500 text-sm mt-1">আপনার ব্যালেন্স, লেনদেনের হিস্ট্রি এবং প্রজেক্টের আয়-ব্যয়ের স্বচ্ছ রিপোর্ট।</p>
</div>

<!-- টপ কার্ডস (ব্যালেন্স) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-brand-black p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute right-0 top-0 w-32 h-32 bg-brand-red/10 rounded-bl-full -z-0"></div>
        <p class="text-gray-400 text-sm font-semibold mb-1 relative z-10">বর্তমান ওয়ালেট ব্যালেন্স</p>
        <h3 class="text-4xl font-bold text-brand-white relative z-10">৳ {{ number_format($user->wallet_balance, 2) }}</h3>

        <div class="mt-6 flex space-x-3 relative z-10">
            <button onclick="document.getElementById('depositModal').classList.remove('hidden')" class="bg-brand-red text-white text-sm px-4 py-2.5 rounded-lg font-bold hover:bg-red-700 transition shadow">
                + ফান্ড অ্যাড
            </button>
            <button onclick="document.getElementById('withdrawModal').classList.remove('hidden')" class="bg-gray-800 text-white text-sm px-4 py-2.5 rounded-lg font-bold hover:bg-gray-700 transition">
                উইথড্র রিকোয়েস্ট
            </button>
        </div>
    </div>

    <!-- গ্রাফ (Chart) সেকশন -->
    <div class="bg-white p-6 rounded-2xl shadow border border-gray-100 flex flex-col justify-center">
        <h4 class="text-sm font-bold text-gray-500 mb-2">আপনার ব্যাচগুলোর আয়-ব্যয়ের গ্রাফ (গত ১০ দিন)</h4>
        <div class="relative h-40 w-full">
            <canvas id="financeChart"></canvas>
        </div>
    </div>
</div>

<!-- লেনদেন ও রিপোর্ট টেবিল সেকশন -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- বাম দিক: ইউজারের ব্যক্তিগত লেনদেন -->
    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50">
            <h3 class="text-lg font-bold text-brand-black">আপনার ব্যক্তিগত লেনদেন</h3>
        </div>
        <div class="max-h-[500px] overflow-y-auto">
            <table class="w-full text-left border-collapse">
                <tbody>
                    @forelse($transactions as $trx)
                    <tr class="border-b border-gray-50 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="font-bold text-sm text-brand-black capitalize">{{ str_replace('_', ' ', $trx->type) }}</div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($trx->created_at)->format('d M, Y h:i A') }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $trx->description }}</div>
                        </td>
                        <td class="p-4 text-right font-bold {{ in_array($trx->type, ['deposit', 'profit']) ? 'text-green-600' : 'text-brand-red' }}">
                            {{ in_array($trx->type, ['deposit', 'profit']) ? '+' : '-' }} ৳{{ number_format($trx->amount) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="p-6 text-center text-gray-500 text-sm">কোনো লেনদেন পাওয়া যায়নি।</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ডান দিক: প্রজেক্টের আয়-ব্যয় রিপোর্ট (স্বচ্ছতা) -->
    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-brand-red/5 flex justify-between items-center">
            <h3 class="text-lg font-bold text-brand-black">প্রজেক্ট আয়-ব্যয় রিপোর্ট</h3>
            <span class="text-xs bg-brand-red text-white px-2 py-1 rounded font-bold">100% Transparent</span>
        </div>
        <div class="p-4 bg-gray-50 text-xs text-gray-600 border-b border-gray-100">
            আপনি যে ব্যাচগুলোতে ইনভেস্ট করেছেন, সেগুলোর প্রতিদিনের আয় ও ব্যয়ের কারণ নিচে দেখানো হলো:
        </div>
        <div class="max-h-[440px] overflow-y-auto">
            <table class="w-full text-left border-collapse">
                <tbody>
                    @forelse($projectFinances as $finance)
                    <tr class="border-b border-gray-50 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="font-bold text-sm text-brand-black">{{ $finance->project->batch->name ?? 'Project' }}</div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($finance->entry_date)->format('d M, Y') }}</div>
                            <div class="text-sm text-gray-700 mt-1 bg-gray-100 p-2 rounded line-clamp-2">📝 {{ $finance->description }}</div>
                        </td>
                        <td class="p-4 text-right align-top">
                            <span class="block font-bold mb-1 {{ $finance->type == 'income' ? 'text-green-600' : 'text-brand-red' }}">
                                {{ $finance->type == 'income' ? '+ ৳' : '- ৳' }}{{ number_format($finance->amount) }}
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded font-bold uppercase {{ $finance->type == 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-brand-red' }}">
                                {{ $finance->type }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="p-6 text-center text-gray-500 text-sm">আপনার ব্যাচে এখনো কোনো আয় বা ব্যয় যুক্ত হয়নি।</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('financeChart').getContext('2d');

        // কন্ট্রোলার থেকে আসা ডাটা
        const labels = {
            !!json_encode($dates) !!
        };
        const incomes = {
            !!json_encode($incomes) !!
        };
        const expenses = {
            !!json_encode($expenses) !!
        };

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'আয় (Income)',
                        data: incomes,
                        backgroundColor: '#16a34a', // Green
                        borderRadius: 4
                    },
                    {
                        label: 'ব্যয় (Expense)',
                        data: expenses,
                        backgroundColor: '#dc2626', // Red
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 10
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<!-- Deposit (ফান্ড অ্যাড) Modal -->
    <div id="depositModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full relative">
            <button onclick="document.getElementById('depositModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-brand-black">ফান্ড যোগ করুন</h2>
            
            <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                <h4 class="font-bold text-sm mb-2 text-brand-red">আমাদের পেমেন্ট ইনফরমেশন:</h4>
                <p class="text-sm"><strong>বিকাশ/নগদ (Personal):</strong> 017XXXXXXXX</p>
                <p class="text-sm mt-2"><strong>Bank:</strong> DBBL<br><strong>A/C Name:</strong> SOURCE 365<br><strong>A/C No:</strong> 123.456.78901</p>
            </div>

            <form action="{{ route('wallet.deposit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold mb-1">পরিমাণ (৳)</label>
                    <input type="number" name="amount" required class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">পেমেন্ট মেথড</label>
                    <select name="payment_method" required class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                        <option value="bkash">বিকাশ</option>
                        <option value="nagad">নগদ</option>
                        <option value="bank">ব্যাংক ট্রান্সফার</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">যেই নাম্বার/অ্যাকাউন্ট থেকে পাঠিয়েছেন</label>
                    <input type="text" name="sender_account_info" required placeholder="Ex: 017XXXXXX or Bank A/C Name" class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">ট্রানজেকশন আইডি (TxnID)</label>
                    <input type="text" name="transaction_id" class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                </div>
                <button type="submit" class="w-full bg-brand-red text-white font-bold py-3 rounded-lg mt-4">রিকোয়েস্ট সাবমিট করুন</button>
            </form>
        </div>
    </div>

    <!-- Withdraw (উইথড্র) Modal -->
    <div id="withdrawModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full relative">
            <button onclick="document.getElementById('withdrawModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-brand-black">টাকা উত্তোলন (Withdraw)</h2>
            
            <p class="text-sm text-gray-500 mb-6">আপনার বর্তমান ব্যালেন্স: <strong class="text-green-600">৳ {{ number_format($user->wallet_balance) }}</strong></p>

            <form action="{{ route('wallet.withdraw') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold mb-1">উত্তোলনের পরিমাণ (৳)</label>
                    <input type="number" name="amount" min="500" max="{{ $user->wallet_balance }}" required placeholder="সর্বনিম্ন ৫০০ টাকা" class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">কীভাবে টাকা নিতে চান?</label>
                    <select name="payment_method" required class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none">
                        <option value="bkash">বিকাশ</option>
                        <option value="nagad">নগদ</option>
                        <option value="bank">ব্যাংক ট্রান্সফার</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">আপনার অ্যাকাউন্ট ডিটেইলস দিন</label>
                    <textarea name="account_details" required rows="3" placeholder="বিকাশ/নগদ নাম্বার অথবা ব্যাংকের নাম, ব্রাঞ্চ, এবং অ্যাকাউন্ট নাম্বার লিখুন..." class="w-full border p-2.5 rounded-lg focus:border-brand-red focus:outline-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white font-bold py-3 rounded-lg mt-4 hover:bg-brand-black">উইথড্র রিকোয়েস্ট পাঠান</button>
            </form>
        </div>
    </div>

@endsection