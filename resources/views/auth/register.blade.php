@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-brand-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-brand-black">অ্যাকাউন্ট তৈরি করুন</h2>
            <p class="text-gray-500 mt-2 text-sm">বিনিয়োগ শুরু করতে আপনার তথ্য দিয়ে যুক্ত হোন</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-bold text-brand-black mb-1">পূর্ণ নাম</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-brand-black mb-1">ইমেইল এড্রেস</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Phone field added manually for future use -->
            <div>
                <label for="phone" class="block text-sm font-bold text-brand-black mb-1">মোবাইল নাম্বার</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red">
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-brand-black mb-1">পাসওয়ার্ড</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red @error('password') border-red-500 @enderror">
                @error('password')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password-confirm" class="block text-sm font-bold text-brand-black mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-brand-red text-brand-white font-bold py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300 shadow-md">
                    অ্যাকাউন্ট তৈরি করুন
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">আগে থেকেই অ্যাকাউন্ট আছে? <a href="{{ route('login') }}" class="font-bold text-brand-black hover:text-brand-red hover:underline">লগইন করুন</a></p>
        </div>
    </div>
</div>
@endsection