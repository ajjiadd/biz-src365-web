@extends('layouts.app')

@section('content')

<!-- 1. Hero Section -->
<section class="relative py-24 bg-brand-black text-center overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-black via-brand-black/90 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-6xl font-bold text-brand-white mb-6">আমাদের <span class="text-brand-red">গল্প</span></h1>
        <div class="w-24 h-1.5 bg-brand-red mx-auto rounded-full mb-8 shadow-[0_0_15px_rgba(255,0,0,0.5)]"></div>
        <p class="text-gray-300 max-w-3xl mx-auto text-lg md:text-xl leading-relaxed">
            প্রযুক্তি ও রিয়েল-ওয়ার্ল্ড ব্যবসার এক অনন্য সমন্বয় হলো SOURCE 365। আমরা ডিজিটাল ইনোভেশনের মাধ্যমে সাধারণ মানুষের জন্য একটি নিরাপদ ও লাভজনক বিনিয়োগের ইকোসিস্টেম তৈরি করছি।
        </p>
    </div>
</section>

<!-- 2. Who We Are (আমাদের পরিচয় ও আইটি ব্যাকগ্রাউন্ড) -->
<section class="py-20 bg-brand-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 relative">
                <div class="absolute inset-0 bg-brand-red/10 transform translate-x-4 translate-y-4 rounded-3xl -z-10"></div>
                <img src="{{ asset('assets/image/3grp.jpeg') }}" alt="Team Source 365" class="rounded-3xl shadow-2xl border border-gray-100">
            </div>
            <div class="lg:w-1/2">
                <span class="text-brand-red font-bold tracking-wider uppercase text-sm mb-2 block">আমাদের পরিচয়</span>
                <h3 class="text-3xl md:text-4xl font-bold text-brand-black mb-6">একটি মাল্টি-সার্ভিস ডিজিটাল এজেন্সি ও ইনভেস্টমেন্ট হাব</h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                    SOURCE 365-এর যাত্রা শুরু হয় একটি ডেডিকেটেড আইটি (IT) এবং ডিজিটাল মার্কেটিং কোম্পানি হিসেবে। প্রফেশনাল ওয়েব ডেভেলপমেন্ট, অ্যাডভান্সড অ্যাপ ডেভেলপমেন্ট এবং ডিজিটাল সার্ভিসের ক্ষেত্রে আমাদের রয়েছে দীর্ঘদিনের অভিজ্ঞতা ও একদল দক্ষ পার্টনার ও টিম মেম্বার।
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                    টেকনোলোজি সেক্টরে কাজ করার সুবাদে আমরা বুঝতে পারি, সঠিক প্রযুক্তি ব্যবহার করে যেকোনো গতানুগতিক ব্যবসাকে (যেমন: ই-কমার্স, ট্রান্সপোর্ট) অত্যন্ত স্বচ্ছ ও লাভজনক মডেলে রূপান্তর করা সম্ভব। আর সেই লক্ষ্য থেকেই আমাদের এই ক্রাউড-ইনভেস্টিং প্ল্যাটফর্মের জন্ম।
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Our Working Areas (আমাদের কাজের ক্ষেত্র) -->
<section class="py-20 bg-gray-50 border-y border-gray-100">
    <div class="container mx-auto px-4 max-w-6xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-brand-black mb-4">আমাদের কাজের পরিধি</h2>
        <p class="text-gray-600 mb-16 max-w-2xl mx-auto">আমরা শুধুমাত্র ফান্ড কালেক্ট করি না, বরং আমাদের আইটি এবং মার্কেটিং স্কিল কাজে লাগিয়ে প্রজেক্টগুলোকে সফল করি।</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="w-14 h-14 bg-brand-red/10 text-brand-red flex items-center justify-center rounded-xl text-2xl mb-6">💻</div>
                <h4 class="text-xl font-bold text-brand-black mb-3">আইটি ও ডিজিটাল সার্ভিস</h4>
                <p class="text-gray-600 leading-relaxed text-sm">
                    কাস্টম ওয়েব ও মোবাইল অ্যাপ ডেভেলপমেন্ট থেকে শুরু করে সার্ভার-সাইড ম্যানেজমেন্ট এবং ডিজিটাল সল্যুশন প্রদানে আমরা প্রতিশ্রুতিবদ্ধ।
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="w-14 h-14 bg-brand-red/10 text-brand-red flex items-center justify-center rounded-xl text-2xl mb-6">📈</div>
                <h4 class="text-xl font-bold text-brand-black mb-3">অ্যাডভান্সড ডিজিটাল মার্কেটিং</h4>
                <p class="text-gray-600 leading-relaxed text-sm">
                    আমাদের ই-কমার্স বা অন্যান্য প্রজেক্টগুলোর প্রসারের জন্য ডেটা-ড্রিভেন মার্কেটিং, কাস্টম অডিয়েন্স এবং সেলস ক্যাম্পেইন ম্যানেজ করে আমাদের এক্সপার্ট টিম।
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="w-14 h-14 bg-brand-red/10 text-brand-red flex items-center justify-center rounded-xl text-2xl mb-6">🤝</div>
                <h4 class="text-xl font-bold text-brand-black mb-3">স্মার্ট ইনভেস্টমেন্ট প্রজেক্ট</h4>
                <p class="text-gray-600 leading-relaxed text-sm">
                    আমাদের নিজস্ব প্রযুক্তিতে তৈরি এই প্ল্যাটফর্মের মাধ্যমে সর্বোচ্চ ২৫ জনের লিমিটেড ব্যাচে আমরা ফান্ডিং গ্রহণ করি এবং তা রিয়েল-বিজনেসে রূপান্তর করি।
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4. New Business Model Section (অল্প পুঁজিতে ব্যবসার মালিকানা) -->
<section class="py-20 bg-brand-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col md:flex-row items-center gap-12 mb-16">
            <div class="md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-black mb-6 leading-snug">অল্প পুঁজিতে <span class="text-brand-red">রিয়েল-লাইফ ব্যবসার</span> গর্বিত অংশীদার হোন!</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    সাধারণত একটি লাভজনক ব্যবসা শুরু করতে ন্যূনতম ১০ থেকে ২০ লাখ বা তারও বেশি টাকার প্রয়োজন হয়। বড় অঙ্কের মূলধনের অভাবে অনেকেরই নিজের ব্যবসার স্বপ্ন পূরণ হয় না। 
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    যারা ব্যবসা করতে চান কিন্তু পর্যাপ্ত মূলধন নেই, তাদের জন্যই আমরা তৈরি করেছি <strong>'ব্যাচ সিস্টেম বিজনেস পার্টনারশিপ'</strong>। আমাদের সাথে যুক্ত হলে লাখ লাখ টাকার মূলধন বা লোকসানের ভয় ছাড়াই, খুব সামান্য বিনিয়োগের মাধ্যমে আপনিও হতে পারেন একটি চলমান ব্যবসার মালিক। 
                </p>
            </div>
            <div class="md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Sector 1 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                    <div class="text-3xl mb-3">🚐</div>
                    <h4 class="font-bold text-brand-black mb-2">পরিবহন খাত</h4>
                    <p class="text-sm text-gray-500">বাস, ট্রাক, লেগুনা, মিনি বাস সহ লাভজনক ট্রান্সপোর্ট প্রজেক্ট।</p>
                </div>
                <!-- Sector 2 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                    <div class="text-3xl mb-3">🌾</div>
                    <h4 class="font-bold text-brand-black mb-2">স্টক বিজনেস</h4>
                    <p class="text-sm text-gray-500">ধান, পাট, ভুট্টা, গম, সরিষা ইত্যাদি সিজনাল পণ্যের স্টক ও ট্রেডিং।</p>
                </div>
                <!-- Sector 3 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                    <div class="text-3xl mb-3">🛒</div>
                    <h4 class="font-bold text-brand-black mb-2">ই-কমার্স ব্যবসা</h4>
                    <p class="text-sm text-gray-500">আধুনিক ও লাভজনক অনলাইন শপিং এবং সাপ্লাই চেইন ম্যানেজমেন্ট।</p>
                </div>
                <!-- Sector 4 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                    <div class="text-3xl mb-3">💻</div>
                    <h4 class="font-bold text-brand-black mb-2">সফটওয়্যার ও আইটি</h4>
                    <p class="text-sm text-gray-500">ওয়েবসাইট, অ্যাপ ডেভেলপমেন্ট ও লাভজনক টেকনোলজি প্রজেক্ট।</p>
                </div>
            </div>
        </div>
        
        <!-- Let's build empire together -->
        <div class="text-center mt-12 bg-brand-black p-8 rounded-2xl shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 bg-brand-red/10 blur-xl"></div>
            <h3 class="text-3xl md:text-5xl font-extrabold text-white tracking-wide relative z-10 font-serif italic">
                "Let's build an empire together..."
            </h3>
        </div>
    </div>
</section>

<!-- 5. Our Mission & Vision (মিশন ও ভিশন) -->
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-brand-black rounded-3xl p-10 md:p-16 relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-red/20 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10">
                <div>
                    <h3 class="text-2xl font-bold text-brand-white mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-brand-red flex items-center justify-center text-sm">🎯</span> আমাদের মিশন
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        প্রযুক্তির শক্তি কাজে লাগিয়ে রিয়েল-লাইফ বিজনেস মডেলে শতভাগ স্বচ্ছতা নিশ্চিত করা। আমাদের ইনভেস্টরদের জন্য এমন একটি ড্যাশবোর্ড উপহার দেওয়া, যেখানে তারা প্রতিদিনের আয়-ব্যয়ের হিসাব দেখতে পারবেন এবং নিশ্চিন্তে বিনিয়োগ করতে পারবেন।
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-brand-white mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-brand-red flex items-center justify-center text-sm">👁️</span> আমাদের ভিশন
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        বাংলাদেশের অন্যতম সেরা এবং নির্ভরযোগ্য ডিজিটাল ইনভেস্টমেন্ট ও আইটি প্ল্যাটফর্ম হিসেবে নিজেদের প্রতিষ্ঠিত করা। যেখানে ছোট-বড় সকল স্তরের মানুষ আস্থার সাথে যুক্ত হয়ে আর্থিকভাবে স্বাবলম্বী হতে পারবে।
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Core Values (কেন আমরা আলাদা) -->
<section class="py-20 bg-brand-white border-t border-gray-100">
    <div class="container mx-auto px-4 max-w-6xl text-center">
        <h2 class="text-3xl font-bold text-brand-black mb-12">যেসব নীতিতে আমরা অটুট</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                <div class="text-brand-red text-3xl mb-4">🔍</div>
                <h4 class="font-bold text-brand-black mb-2">১০০% স্বচ্ছতা</h4>
                <p class="text-gray-500 text-sm">কোনো হিডেন চার্জ নেই। প্রতিদিনের লাভ-ক্ষতির স্পষ্ট হিসাব ড্যাশবোর্ডে উন্মুক্ত থাকে।</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                <div class="text-brand-red text-3xl mb-4">🔒</div>
                <h4 class="font-bold text-brand-black mb-2">লিমিটেড ব্যাচ</h4>
                <p class="text-gray-500 text-sm">অতিরিক্ত বিনিয়োগ নিয়ে রিস্ক না বাড়াতে প্রতিটি প্রজেক্ট মাত্র ২৫ জনের মধ্যে সীমাবদ্ধ।</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                <div class="text-brand-red text-3xl mb-4">⚡</div>
                <h4 class="font-bold text-brand-black mb-2">অটোমেটেড প্রযুক্তি</h4>
                <p class="text-gray-500 text-sm">প্রফিট বন্টন থেকে শুরু করে উইথড্র সিস্টেম—সবকিছুই স্বয়ংক্রিয়ভাবে পরিচালিত হয়।</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-brand-red transition">
                <div class="text-brand-red text-3xl mb-4">🤝</div>
                <h4 class="font-bold text-brand-black mb-2">যৌথ উদ্যোগ</h4>
                <p class="text-gray-500 text-sm">দক্ষ পার্টনার এবং ইনভেস্টরদের সম্মিলিত চেষ্টায় আমরা প্রতিটি প্রজেক্ট সফল করে তুলি।</p>
            </div>
        </div>
    </div>
</section>

@endsection