@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-brand-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-brand-black">লগইন করুন</h2>
            <p class="text-gray-500 mt-2 text-sm">আপনার ড্যাশবোর্ডে প্রবেশ করতে ইমেইল ও পাসওয়ার্ড দিন</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-brand-black mb-2">ইমেইল এড্রেস</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-brand-black mb-2">পাসওয়ার্ড</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input class="h-4 w-4 text-brand-red focus:ring-brand-red border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-700" for="remember">মনে রাখুন</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-brand-red hover:text-red-700" href="{{ route('password.request') }}">পাসওয়ার্ড ভুলে গেছেন?</a>
                @endif
            </div>

            <div>
                <button type="submit" class="w-full bg-brand-black text-brand-white font-bold py-3 px-4 rounded-lg hover:bg-brand-red transition duration-300 shadow-md">
                    প্রবেশ করুন
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">অ্যাকাউন্ট নেই? <a href="{{ route('register') }}" class="font-bold text-brand-red hover:underline">নতুন অ্যাকাউন্ট খুলুন</a></p>
        </div>
    </div>
</div>
@endsection