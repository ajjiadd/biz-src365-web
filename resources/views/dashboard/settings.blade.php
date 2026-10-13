@extends('layouts.dashboard')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 font-bold shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 font-bold shadow-sm">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 font-bold shadow-sm">
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-brand-black">অ্যাকাউন্ট সেটিংস ⚙️</h2>
        <p class="text-gray-500 text-sm mt-1">আপনার প্রোফাইলের তথ্য এবং অ্যাকাউন্ট সিকিউরিটি আপডেট করুন।</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- ১. প্রোফাইল আপডেট ফর্ম -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                <span class="text-xl mr-2">👤</span>
                <h3 class="text-lg font-bold text-brand-black">প্রোফাইলের তথ্য</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">আপনার সম্পূর্ণ নাম</label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">ইমেইল অ্যাড্রেস</label>
                        <input type="email" name="email" value="{{ $user->email }}" required class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm transition bg-gray-50">
                        <p class="text-xs text-gray-500 mt-1">এই ইমেইলটি আপনার লগইন আইডি হিসেবে ব্যবহৃত হবে।</p>
                    </div>
                    
                    <button type="submit" class="bg-brand-black text-brand-white font-bold py-2.5 px-6 rounded-lg hover:bg-brand-red transition duration-300 mt-4 shadow-md">
                        তথ্য আপডেট করুন
                    </button>
                </form>
            </div>
        </div>

        <!-- ২. পাসওয়ার্ড পরিবর্তন ফর্ম -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                <span class="text-xl mr-2">🔒</span>
                <h3 class="text-lg font-bold text-brand-black">পাসওয়ার্ড পরিবর্তন</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('user.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">বর্তমান পাসওয়ার্ড</label>
                        <input type="password" name="current_password" required placeholder="আপনার বর্তমান পাসওয়ার্ড দিন" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">নতুন পাসওয়ার্ড</label>
                        <input type="password" name="new_password" required placeholder="কমপক্ষে ৬ অক্ষরের পাসওয়ার্ড দিন" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-brand-black mb-1">নতুন পাসওয়ার্ড (পুনরায় লিখুন)</label>
                        <input type="password" name="new_password_confirmation" required placeholder="নতুন পাসওয়ার্ডটি আবার লিখুন" class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:border-brand-red text-sm transition">
                    </div>
                    
                    <button type="submit" class="bg-brand-red text-brand-white font-bold py-2.5 px-6 rounded-lg hover:bg-red-700 transition duration-300 mt-4 shadow-md">
                        পাসওয়ার্ড সেভ করুন
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection