<!DOCTYPE html>
<html lang="bn" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOURCE 365 - বিশ্বস্ত বিনিয়োগ প্ল্যাটফর্ম</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/image/fav.png') }}">
    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
        }
    </style>
</head>

<body class="bg-brand-white text-brand-black antialiased">

    <!-- Navbar -->
    <header class="bg-brand-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-bold tracking-wider text-brand-black">
                SOURCE <span class="text-brand-red">365</span>
            </a>

            <nav class="hidden md:flex space-x-8 text-sm font-bold uppercase tracking-wide">
                <a href="{{ url('/') }}" class="font-semibold transition {{ request()->is('/') ? 'text-brand-red' : 'text-gray-700 hover:text-brand-red' }}">হোম</a>
                <a href="{{ route('about') }}" class="font-semibold transition {{ request()->routeIs('about') ? 'text-brand-red' : 'text-gray-700 hover:text-brand-red' }}">আমাদের সম্পর্কে</a>
                <a href="{{ route('how_it_works') }}" class="font-semibold transition {{ request()->routeIs('how_it_works') ? 'text-brand-red' : 'text-gray-700 hover:text-brand-red' }}">কীভাবে কাজ করে</a>
                <a href="{{ route('investment_batches') }}" class="font-semibold transition {{ request()->routeIs('investment_batches') ? 'text-brand-red' : 'text-gray-700 hover:text-brand-red' }}">বিনিয়োগ ব্যাচ</a>
                <a href="{{ route('portfolio') }}" class="font-semibold transition {{ request()->routeIs('portfolio') ? 'text-brand-red' : 'text-gray-700 hover:text-brand-red' }}">পোর্টফোলিও</a>
            </nav>

            <!-- হেডারের ডান দিকের বাটনগুলো (Login/Register এর জায়গা) -->
            <div>
                @guest
                <a href="{{ route('login') }}" class="text-brand-black hover:text-brand-red font-bold transition duration-300 mr-4">লগইন</a>
                <a href="{{ route('register') }}" class="bg-brand-red text-brand-white px-6 py-2.5 rounded-full hover:bg-red-700 transition duration-300 font-bold shadow-lg shadow-red-500/30">অ্যাকাউন্ট খুলুন</a>
                @else
                <!-- ইউজার অ্যাডমিন নাকি ইনভেস্টর সে অনুযায়ী ড্যাশবোর্ডে পাঠাবে -->
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="text-brand-black hover:text-brand-red font-bold transition duration-300 mr-4">ড্যাশবোর্ড</a>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('app-logout-form').submit();"
                    class="bg-brand-black text-brand-white px-6 py-2.5 rounded-full hover:bg-gray-800 transition duration-300 font-bold">লগআউট</a>
                <form id="app-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-brand-black pt-16 pb-8 border-t-4 border-brand-red mt-auto">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

                <!-- Column 1: Company Info -->
                <div>
                    <a href="{{ url('/') }}" class="text-3xl font-bold text-brand-white tracking-wider mb-4 block">
                        SOURCE <span class="text-brand-red">365</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        SOURCE 365 হলো একটি বিশ্বস্ত ডিজিটাল ইনভেস্টমেন্ট এবং আইটি প্ল্যাটফর্ম। আমরা শতভাগ স্বচ্ছতার সাথে রিয়েল-ওয়ার্ল্ড প্রজেক্ট পরিচালনা করে ইনভেস্টরদের সর্বোচ্চ মুনাফা নিশ্চিত করি।
                    </p>
                    <!-- Social Media Icons (আপাতত হ্যাশ দেওয়া আছে, পরে আপনার পেজের লিংক বসিয়ে নিবেন) -->
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/source365bd" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-red hover:text-white transition duration-300">
                            <span class="text-lg font-bold">f</span>
                        </a>
                        <a href="https://www.linkedin.com/in/sourceofficial-agency-9ba708426/" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-red hover:text-white transition duration-300">
                            <span class="text-lg font-bold">in</span>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-brand-white font-bold text-lg mb-6 relative inline-block">
                        কোম্পানি
                        <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-brand-red rounded-full"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> আমাদের সম্পর্কে</a></li>
                        <li><a href="{{ route('how_it_works') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> কীভাবে কাজ করে</a></li>
                        <li><a href="{{ route('portfolio') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> পোর্টফোলিও</a></li>
                        <li><a href="{{ url('/#contact') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> যোগাযোগ করুন</a></li>
                    </ul>
                </div>

                <!-- Column 3: Investment & Support -->
                <div>
                    <h4 class="text-brand-white font-bold text-lg mb-6 relative inline-block">
                        বিনিয়োগ ও সাপোর্ট
                        <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-brand-red rounded-full"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('investment_batches') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> রানিং ব্যাচসমূহ</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> ড্যাশবোর্ড লগইন</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> নতুন অ্যাকাউন্ট খুলুন</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-red transition duration-300 text-sm flex items-center"><span class="mr-2 text-xs">❯</span> শর্তাবলী ও নীতিমালা</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info (Updated) -->
                <div>
                    <h4 class="text-brand-white font-bold text-lg mb-6 relative inline-block">
                        যোগাযোগ
                        <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-brand-red rounded-full"></span>
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="text-brand-red mr-3 mt-1 text-lg">📍</span>
                            <span class="text-gray-400 text-sm leading-relaxed">Ashulia School & College Market, Ashulia, Savar, Dhaka.</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-brand-red mr-3 text-lg">📞</span>
                            <span class="text-gray-400 text-sm">01408185023</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-brand-red mr-3 text-lg">✉️</span>
                            <span class="text-gray-400 text-sm">contact@source365.org</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} <span class="text-brand-white font-bold">SOURCE 365</span>. All Rights Reserved.
                </p>
                <div class="flex space-x-6 text-sm">
                    
                        <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-brand-red transition duration-300">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="text-gray-500 hover:text-brand-red transition duration-300">Terms of Service</a>
                    
                </div>
            </div>
        </div>
    </footer>

</body>

</html>