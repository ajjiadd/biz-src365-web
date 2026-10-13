<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - SOURCE 365</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-brand-black antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-brand-black text-brand-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-gray-800">
            <a href="/" class="text-2xl font-bold tracking-wider">
                SOURCE <span class="text-brand-red">365</span>
            </a>
        </div>
        <nav class="space-y-2 mt-6">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">📊</span> ড্যাশবোর্ড
            </a>

            <a href="{{ route('user.batches') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('user.batches') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">💼</span> আমার ব্যাচসমূহ
            </a>

            <a href="{{ route('user.wallet') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('user.wallet') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">💰</span> ওয়ালেট ও লেনদেন
            </a>

            <a href="{{ route('user.settings') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('user.settings') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">⚙️</span> সেটিংস
            </a>
        </nav>
        <!-- সাইডবারের লগআউট অংশ (বামের মেনুর একদম নিচে) -->
        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center px-4 py-3 text-gray-400 hover:text-brand-red hover:bg-gray-800 rounded-lg font-bold transition">
                <span class="mr-3">🚪</span> লগআউট
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Header -->
        <header class="h-16 bg-brand-white border-b border-gray-200 flex items-center justify-between px-6 z-10">
            <div class="flex items-center md:hidden">
                <span class="text-xl font-bold text-brand-black">SOURCE <span class="text-brand-red">365</span></span>
            </div>
            <div class="hidden md:block">
                <h2 class="text-xl font-bold text-brand-black">ওভারভিউ</h2>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-brand-red transition relative">
                    🔔
                    <span class="absolute top-0 right-0 w-2 h-2 bg-brand-red rounded-full"></span>
                </button>
                <!-- হেডারের প্রোফাইল অংশ (ডান দিকের উপরের কোণায়) -->
                <div class="flex items-center space-x-2 border-l border-gray-200 pl-4">
                    <div class="w-8 h-8 bg-brand-black text-brand-white rounded-full flex items-center justify-center font-bold uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }} <!-- নামের প্রথম অক্ষর -->
                    </div>
                    <span class="font-bold text-sm">{{ Auth::user()->name }}</span> <!-- ইউজারের আসল নাম -->
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @yield('content')
        </main>
    </div>

</body>

</html>