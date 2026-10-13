@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 font-bold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 font-bold">{{ session('error') }}</div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-brand-black">ইউজার ম্যানেজমেন্ট</h2>
        <p class="text-gray-500 text-sm mt-1">সিস্টেমের সকল বিনিয়োগকারী এবং অ্যাডমিনদের তালিকা, ব্যালেন্স ও তথ্য পরিবর্তন।</p>
    </div>

    <!-- ইউজার তালিকা -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">নাম ও ইমেইল</th>
                    <th class="p-4 border-b">ওয়ালেট ব্যালেন্স (পাওনা)</th>
                    <th class="p-4 border-b">বিনিয়োগকৃত ব্যাচ</th>
                    <th class="p-4 border-b">বর্তমান রোল</th>
                    <th class="p-4 border-b text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">
                        <span class="font-bold text-brand-black block">{{ $user->name }}</span>
                        <span class="text-xs text-gray-500">{{ $user->email }}</span>
                    </td>
                    <td class="p-4 border-b">
                        <span class="font-bold text-green-600 text-lg">৳ {{ number_format($user->wallet_balance, 2) }}</span>
                    </td>
                    <td class="p-4 border-b">
                        <span class="bg-gray-200 text-gray-700 text-xs font-bold px-2 py-1 rounded">
                            {{ $user->batches_count }} টি ব্যাচ
                        </span>
                    </td>
                    <td class="p-4 border-b">
                        @if($user->role == 'admin')
                            <span class="bg-brand-black text-white text-xs font-bold px-2 py-1 rounded uppercase">Admin</span>
                        @else
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded uppercase">Investor</span>
                        @endif
                    </td>
                    <td class="p-4 border-b text-right flex justify-end">
                        <!-- Edit Button -->
                        <button onclick="document.getElementById('editUserModal{{ $user->id }}').classList.remove('hidden')" class="bg-blue-500 text-white px-4 py-1.5 rounded text-sm font-bold hover:bg-blue-600 transition shadow">
                            এডিট করুন
                        </button>
                    </td>
                </tr>

                <!-- Edit User Modal -->
                <div id="editUserModal{{ $user->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full relative text-left">
                        <button onclick="document.getElementById('editUserModal{{ $user->id }}').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
                        <h2 class="text-2xl font-bold mb-6 text-brand-black">ইউজারের তথ্য আপডেট</h2>
                        
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold text-brand-black mb-1">ইউজারের নাম</label>
                                <input type="text" name="name" value="{{ $user->name }}" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-brand-black mb-1">ইমেইল অ্যাড্রেস</label>
                                <input type="email" name="email" value="{{ $user->email }}" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-brand-black mb-1">নতুন পাসওয়ার্ড (ঐচ্ছিক)</label>
                                <input type="password" name="password" placeholder="পরিবর্তন না করতে চাইলে ফাঁকা রাখুন" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-brand-black mb-1">অ্যাকাউন্টের রোল</label>
                                <select name="role" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm">
                                    <option value="investor" {{ $user->role == 'investor' ? 'selected' : '' }}>Investor (বিনিয়োগকারী)</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (অ্যাডমিন)</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="w-full bg-brand-red text-white font-bold py-3 rounded-lg hover:bg-red-700 transition duration-300 mt-4 shadow-lg">
                                সেভ করুন
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        কোনো ইউজার পাওয়া যায়নি।
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection