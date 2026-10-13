<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SOURCE 365</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-brand-black antialiased flex h-screen overflow-hidden">

    <!-- Admin Sidebar -->
    <aside class="w-64 bg-brand-black text-brand-white flex flex-col hidden md:flex border-r border-brand-red">
        <div class="h-16 flex items-center justify-center border-b border-gray-800 bg-brand-black">
            <a href="/" class="text-2xl font-bold tracking-wider">
                SOURCE <span class="text-brand-red">365</span>
                <span class="block text-[10px] text-gray-400 text-center tracking-widest mt-0.5 uppercase">Admin Panel</span>
            </a>
        </div>
        <nav class="space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">📊</span> ড্যাশবোর্ড
            </a>

            <a href="{{ route('admin.batches') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.batches') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">📦</span> ব্যাচ ম্যানেজমেন্ট
            </a>

            <a href="{{ route('admin.projects') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.projects') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">🏢</span> প্রজেক্ট ম্যানেজমেন্ট
            </a>

            <a href="{{ route('admin.finances') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.finances') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">📝</span> আয়-ব্যয় (P&L)
            </a>

            <a href="{{ route('admin.profit.index') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.profit.index') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">💸</span> প্রফিট ডিস্ট্রিবিউশন
            </a>

            <a href="{{ route('admin.deposits') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.deposits') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">💳</span> ফান্ড রিকোয়েস্ট
            </a>

            <a href="{{ route('admin.withdrawals') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.withdrawals') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">📤</span> উইথড্র রিকোয়েস্ট
            </a>

            <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.users') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">👥</span> ইউজার ম্যানেজমেন্ট
            </a>

            <a href="{{ route('admin.testimonials') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.testimonials') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">💬</span> গ্রাহকের মতামত
            </a>

            <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 rounded-lg font-semibold transition {{ request()->routeIs('admin.settings') ? 'bg-gray-800 text-brand-red border-l-4 border-brand-red' : 'text-gray-400 hover:text-brand-white hover:bg-gray-800' }}">
                <span class="mr-3">⚙️</span> সাইট সেটিংস
            </a>
        </nav>
        <!-- সাইডবারের লগআউট অংশ -->
        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
                class="flex items-center px-4 py-3 text-gray-400 hover:text-brand-red hover:bg-gray-800 rounded-lg font-bold transition">
                <span class="mr-3">🚪</span> লগআউট
            </a>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Header -->
        <header class="h-16 bg-brand-white border-b border-gray-200 flex items-center justify-between px-6 z-10 shadow-sm">
            <div class="flex items-center md:hidden">
                <span class="text-xl font-bold text-brand-black">SOURCE <span class="text-brand-red">365</span></span>
            </div>
            <div class="hidden md:block">
                <h2 class="text-xl font-bold text-brand-black">অ্যাডমিন কন্ট্রোল প্যানেল</h2>
            </div>
            <div class="flex items-center space-x-4">
                <button class="bg-brand-black text-brand-white text-xs px-4 py-2 rounded font-bold hover:bg-gray-800 transition">
                    + নতুন ব্যাচ
                </button>
                <!-- হেডারের প্রোফাইল অংশ -->
                <div class="flex items-center space-x-2 border-l border-gray-200 pl-4">
                    <div class="w-8 h-8 bg-brand-red text-brand-white rounded-full flex items-center justify-center font-bold uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="font-bold text-sm">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            @yield('content')
        </main>
    </div>

</body>

</html>