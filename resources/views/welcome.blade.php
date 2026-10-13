@extends('layouts.app')

@section('content')

<!-- 1. Hero Section (Dynamic) -->
<section class="relative h-[600px] flex items-center justify-center bg-brand-black">
    <!-- আগে Unsplash এর লিংক ছিল, এখন এটি দিন -->
    <img src="{{ isset($settings['hero_bg_image']) ? asset('storage/' . $settings['hero_bg_image']) : 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=1920&q=80' }}" alt="Banner" class="absolute inset-0 w-full h-full object-cover opacity-50">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-black via-brand-black/80 to-transparent"></div>

    <div class="container mx-auto px-4 relative z-10 text-left">
        <div class="max-w-2xl">
            <span class="inline-block py-1 px-3 border border-brand-red text-brand-red font-bold rounded-full text-sm mb-4 bg-brand-red/10">
                {{ $settings['hero_subtitle'] ?? 'স্মার্ট বিনিয়োগ, নিশ্চিত ভবিষ্যৎ' }}
            </span>
            <h1 class="text-5xl md:text-6xl font-bold text-brand-white mb-6 leading-tight">
                {!! nl2br(e($settings['hero_title'] ?? "২৫ জনের এক্সক্লুসিভ \n বিনিয়োগ ব্যাচ")) !!}
            </h1>
            <p class="text-gray-300 text-lg mb-8">
                {{ $settings['hero_desc'] ?? 'SOURCE 365 এর মাধ্যমে নিরাপদ প্রজেক্টে বিনিয়োগ করুন। প্রতিটি ব্যাচে শুধুমাত্র ২৫ জন সদস্য। আমাদের রিয়েল-ওয়ার্ল্ড ব্যবসা থেকে আজই আয় শুরু করুন।' }}
            </p>
            <div class="flex space-x-4">
                <a href="#batches" class="bg-brand-red text-brand-white px-8 py-3 rounded-full text-lg font-bold hover:bg-red-700 transition shadow-[0_0_15px_rgba(255,0,0,0.4)]">
                    বিনিয়োগ শুরু করুন
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. Statistics / Trust Bar (Dynamic) -->
<section class="bg-brand-black border-b-4 border-brand-red py-10 relative z-20 -mt-2">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-gray-800">
            <div>
                <h3 class="text-4xl font-bold text-brand-white mb-1">{{ $settings['stat_projects'] ?? '১২+' }}</h3>
                <p class="text-gray-400 font-semibold">সফল প্রজেক্ট</p>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-brand-white mb-1">{{ $settings['stat_investors'] ?? '৩০০+' }}</h3>
                <p class="text-gray-400 font-semibold">বিনিয়োগকারী</p>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-brand-white mb-1">{{ $settings['stat_profit'] ?? '৳ 5M+' }}</h3>
                <p class="text-gray-400 font-semibold">মোট প্রফিট ডিস্ট্রিবিউশন</p>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-brand-red mb-1">১০০%</h3>
                <p class="text-gray-400 font-semibold">স্বচ্ছতা</p>
            </div>
        </div>
    </div>
</section>

<!-- 2.5 New Business Model Concept -->
<section class="py-24 bg-brand-white border-b border-gray-100 overflow-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left Side: Image Section -->
            <div class="lg:w-1/2 relative w-full">
                <!-- Background Decoration -->
                <div class="absolute inset-0 bg-brand-red/10 transform -translate-x-6 translate-y-6 rounded-3xl -z-10"></div>
                
                <!-- Main Image -->
                <img src="{{ asset('assets/image/tanvir.jpg') }}" alt="Business Partnership" class="rounded-3xl shadow-2xl border border-gray-100 w-full object-cover h-[450px] md:h-[550px]">
                
                <!-- Floating Empire Badge -->
                <div class="absolute bottom-8 -right-4 md:right-8 bg-brand-black text-white p-5 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.3)] border border-gray-800 backdrop-blur-sm animate-bounce-slow">
                    <p class="font-bold text-brand-red text-xl font-serif italic mb-1">"Let's build</p>
                    <p class="text-sm text-gray-300">an empire together"</p>
                </div>
            </div>

            <!-- Right Side: Text & Info Section -->
            <div class="lg:w-1/2 mt-10 lg:mt-0">
                <span class="inline-block py-1.5 px-4 border border-brand-red text-brand-red font-bold rounded-full text-xs uppercase tracking-widest mb-6 bg-brand-red/5">স্মার্ট পার্টনারশিপ</span>
                
                <h2 class="text-3xl md:text-5xl font-bold text-brand-black mb-6 leading-tight">
                    লাখ লাখ টাকা ছাড়াই <br><span class="text-brand-red">রিয়েল-লাইফ ব্যবসার</span> মালিকানা!
                </h2>
                
                <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                    একটি নতুন ব্যবসা শুরু করতে সাধারণত <strong class="text-brand-black">১০ থেকে ২০ লাখ</strong> টাকার প্রয়োজন হয়। বিশাল এই মূলধনের অভাবে অনেকেরই নিজের ব্যবসার স্বপ্ন পূরণ হয় না।
                </p>
                <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                    কিন্তু SOURCE 365-এর <strong class="text-brand-red">‘ব্যাচ সিস্টেম বিজনেস পার্টনারশিপ’</strong>-এর মাধ্যমে খুব সামান্য পুঁজি দিয়েই আপনি একটি লাভজনক ব্যবসার অংশীদার হতে পারেন। কোনো লোকসানের ভয় নেই, সাথে থাকছে বিশ্বস্ত পার্টনার!
                </p>

                <!-- Sectors Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition group">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-2xl shadow-sm group-hover:bg-brand-red group-hover:text-white transition">🚐</div>
                        <span class="font-bold text-brand-black">পরিবহন খাত</span>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition group">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-2xl shadow-sm group-hover:bg-brand-red group-hover:text-white transition">🌾</div>
                        <span class="font-bold text-brand-black">স্টক বিজনেস</span>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition group">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-2xl shadow-sm group-hover:bg-brand-red group-hover:text-white transition">🛒</div>
                        <span class="font-bold text-brand-black">ই-কমার্স ব্যবসা</span>
                    </div>
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition group">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-2xl shadow-sm group-hover:bg-brand-red group-hover:text-white transition">💻</div>
                        <span class="font-bold text-brand-black">সফটওয়্যার ও আইটি</span>
                    </div>
                </div>
                
                <!-- Action Button -->
                <div class="mt-10">
                    <a href="{{ route('about') }}" class="inline-flex items-center bg-brand-black text-white px-8 py-3.5 rounded-full font-bold hover:bg-brand-red transition shadow-lg">
                        আরও বিস্তারিত জানুন <span class="ml-2 text-xl">→</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. How It Works -->
<section id="how-it-works" class="py-20 bg-brand-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-brand-black mb-3">কাজের প্রক্রিয়া</h2>
            <div class="w-16 h-1 bg-brand-red mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">খুব সহজেই আমাদের সাথে যুক্ত হয়ে বিনিয়োগ শুরু করতে পারেন।</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white p-8 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-brand-red transition group text-center">
                <div class="w-20 h-20 bg-brand-red/10 text-brand-red rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 group-hover:bg-brand-red group-hover:text-brand-white transition">১</div>
                <h3 class="text-2xl font-bold text-brand-black mb-3">ব্যাচ নির্বাচন</h3>
                <p class="text-gray-600">আমাদের চলমান প্রজেক্ট থেকে আপনার পছন্দের ২৫ জনের ব্যাচে নির্দিষ্ট পরিমাণ টাকা বিনিয়োগ করুন।</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-brand-red transition group text-center">
                <div class="w-20 h-20 bg-brand-red/10 text-brand-red rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 group-hover:bg-brand-red group-hover:text-brand-white transition">২</div>
                <h3 class="text-2xl font-bold text-brand-black mb-3">আমাদের পরিচালনা</h3>
                <p class="text-gray-600">ফান্ড সংগ্রহ হলে SOURCE 365 সরাসরি ব্যবসা বা অ্যাসেট পরিচালনা শুরু করবে।</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-brand-red transition group text-center">
                <div class="w-20 h-20 bg-brand-red/10 text-brand-red rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 group-hover:bg-brand-red group-hover:text-brand-white transition">৩</div>
                <h3 class="text-2xl font-bold text-brand-black mb-3">মুনাফা গ্রহণ</h3>
                <p class="text-gray-600">ড্যাশবোর্ডের মাধ্যমে আয়-ব্যয় দেখুন এবং অর্জিত মুনাফা সরাসরি আপনার ওয়ালেটে পেয়ে যান।</p>
            </div>
        </div>
    </div>
</section>


<!-- 4.2 Security & Trust Pillars -->
<section class="py-16 bg-brand-black relative">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-brand-white mb-3">আপনার বিনিয়োগ কতটা নিরাপদ?</h2>
            <div class="w-16 h-1 bg-brand-red mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Pillar 1 -->
            <div class="p-6">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                    <svg class="w-8 h-8 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-brand-white mb-2">রিয়েল অ্যাসেট ব্যাকড</h4>
                <p class="text-gray-400 text-sm">আপনার টাকা ভার্চুয়াল কোনো স্কিমে নয়, বরং বাস, ট্রাক এবং লাভজনক এজেন্সির মতো ফিজিক্যাল ও ডিজিটাল অ্যাসেটে বিনিয়োগ করা হয়।</p>
            </div>
            <!-- Pillar 2 -->
            <div class="p-6">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                    <svg class="w-8 h-8 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-brand-white mb-2">স্বচ্ছ লিগ্যাল ডকুমেন্টেশন</h4>
                <p class="text-gray-400 text-sm">প্রতিটি ব্যাচের জন্য সুস্পষ্ট চুক্তিপত্র থাকে। যা আপনার ড্যাশবোর্ড থেকে যেকোনো সময় ডাউনলোড এবং ভেরিফাই করতে পারবেন।</p>
            </div>
            <!-- Pillar 3 -->
            <div class="p-6">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                    <svg class="w-8 h-8 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-brand-white mb-2">কঠোর ফান্ড ম্যানেজমেন্ট</h4>
                <p class="text-gray-400 text-sm">ফান্ডিং শুধুমাত্র এক্সপার্টদের দ্বারা পরিচালিত হয় এবং লস কমানোর জন্য ডাইভারসিফাইড পোর্টফোলিও ব্যবহার করা হয়।</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. Open Investment Batches -->
<section id="batches" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-bold text-brand-black mb-3">চলমান ব্যাচসমূহ</h2>
                <div class="w-16 h-1 bg-brand-red rounded-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($openBatches as $batch)
            <div class="bg-brand-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="h-48 relative overflow-hidden bg-gray-200">
                    @if($batch->image)
                    <img src="{{ asset('storage/' . $batch->image) }}" class="w-full h-full object-cover" alt="{{ $batch->name }}">
                    @else
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Default Project Image">
                    @endif
                    <span class="absolute top-4 right-4 bg-brand-red text-white text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $batch->status }}</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-brand-black mb-2">{{ $batch->name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($batch->description, 60) }}</p>

                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">বিনিয়োগ (জনপ্রতি):</span>
                        <span class="text-brand-black font-bold text-lg">৳ {{ number_format($batch->investment_amount) }}</span>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1 font-bold">
                            <span class="text-brand-red">যুক্ত হয়েছেন</span>
                            <span class="text-brand-black">{{ $batch->joined_members }} / {{ $batch->max_members }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
                            @php $progress = ($batch->joined_members / $batch->max_members) * 100; @endphp
                            <div class="bg-brand-red h-2 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    @auth
                    <form action="{{ route('batch.join', $batch->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full border-2 border-brand-red text-brand-red font-bold py-2.5 rounded-full hover:bg-brand-red hover:text-brand-white transition">
                            ব্যাচে জয়েন করুন
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="block text-center w-full bg-gray-200 text-gray-700 font-bold py-2.5 rounded-full hover:bg-gray-300 transition">
                        জয়েন করতে লগইন করুন
                    </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10">
                <p class="text-gray-500 text-lg">বর্তমানে কোনো নতুন ব্যাচ ওপেন নেই।</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 4.2 Legal Documentation & Ownership -->
<section class="py-20 bg-white border-b border-gray-100 overflow-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left Side: Image (Signing Document) -->
            <div class="lg:w-1/2 relative w-full">
                <!-- Background Decoration -->
                <div class="absolute inset-0 bg-brand-red/10 transform -translate-x-5 translate-y-5 rounded-3xl -z-10"></div>
                
                <!-- Main Image -->
                <img src="{{ asset('assets/image/swadhin.jpeg') }}" alt="Signing Legal Documents" class="rounded-3xl shadow-2xl border border-gray-100 w-full object-cover h-[400px] md:h-[500px]">
                
                <!-- Trust Badge (Floating) -->
                <div class="absolute top-8 -left-4 md:-left-8 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-4 animate-bounce-slow">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl font-bold shadow-inner">✓</div>
                    <div>
                        <p class="font-bold text-brand-black">১০০% লিগ্যাল</p>
                        <p class="text-xs text-gray-500">স্ট্যাম্প ও চুক্তিপত্র</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="lg:w-1/2 mt-10 lg:mt-0">
                <span class="inline-block py-1.5 px-4 border border-brand-red text-brand-red font-bold rounded-full text-xs uppercase tracking-widest mb-6 bg-brand-red/5">লিগ্যাল ডকুমেন্টস ও মালিকানা</span>
                
                <h2 class="text-3xl md:text-4xl font-bold text-brand-black mb-6 leading-tight">
                    ব্যাচে জয়েন করেই বুঝে নিন <br><span class="text-brand-red">ব্যবসার মালিকানার কাগজপত্র!</span>
                </h2>
                
                <p class="text-gray-600 mb-5 text-lg leading-relaxed">
                    উপরের ব্যাচগুলোতে জয়েন করার মাধ্যমে আপনি শুধু ইনভেস্ট করছেন না, বরং আজই সরাসরি একটি রিয়েল-লাইফ ব্যবসার মালিকানা পাচ্ছেন। ব্যাচে জয়েন করার পরপরই আপনি চাইলে SOURCE 365-এর ফিজিক্যাল অফিসে (আশুলিয়া, ঢাকা) এসে সরাসরি আপনার ব্যবসার যাবতীয় ডকুমেন্টস এবং মালিকানার কাগজপত্র বুঝে নিতে পারবেন।
                </p>
                <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                    আর আপনি যদি অনলাইনে যুক্ত হন বা সরাসরি অফিসে আসতে না পারেন, তবে কোনো চিন্তা নেই! আপনার প্রদানকৃত নির্দিষ্ট ঠিকানায় কুরিয়ারের মাধ্যমে অরিজিনাল ফিজিক্যাল স্ট্যাম্প ও লিগ্যাল ডকুমেন্টস পাঠিয়ে দেওয়া হবে।
                </p>

                <!-- Features List -->
                <ul class="space-y-4">
                    <li class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition">
                        <div class="w-12 h-12 bg-brand-black text-white rounded-full flex items-center justify-center font-bold shadow-md shrink-0 text-xl">🏢</div>
                        <span class="font-bold text-brand-black">যেকোনো সময় ফিজিক্যাল অফিসে ভিজিটের সুযোগ</span>
                    </li>
                    <li class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition">
                        <div class="w-12 h-12 bg-brand-black text-white rounded-full flex items-center justify-center font-bold shadow-md shrink-0 text-xl">📝</div>
                        <span class="font-bold text-brand-black">অফিসিয়াল স্ট্যাম্পে লিগ্যাল চুক্তিপত্র</span>
                    </li>
                    <li class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-brand-red transition">
                        <div class="w-12 h-12 bg-brand-black text-white rounded-full flex items-center justify-center font-bold shadow-md shrink-0 text-xl">🚚</div>
                        <span class="font-bold text-brand-black">সারা দেশে কুরিয়ারের মাধ্যমে ডকুমেন্টস ডেলিভারি</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- 4.5 Latest Announcements / Updates (Dynamic) -->
<section class="py-16 bg-brand-white border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="bg-brand-black rounded-3xl p-8 md:p-12 relative overflow-hidden shadow-2xl flex flex-col md:flex-row items-center justify-between">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-red/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 md:w-2/3 mb-6 md:mb-0">
                <span class="bg-brand-red text-white text-xs font-bold px-3 py-1 rounded-full uppercase mb-4 inline-block">নতুন আপডেট</span>
                <h3 class="text-2xl md:text-3xl font-bold text-brand-white mb-2">
                    {{ $settings['announcement_title'] ?? 'ই-কমার্স প্রজেক্টের জন্য নতুন অডিয়েন্স কনফিগারেশন সম্পন্ন!' }}
                </h3>
                <p class="text-gray-400">
                    {{ $settings['announcement_desc'] ?? 'আমাদের টিমের নতুন সার্ভার-সাইড ট্র্যাকিং এবং কাস্টম অডিয়েন্স সেটআপের কারণে প্রজেক্টের সেলস ২০% বৃদ্ধি পেয়েছে। এর ফলে পরবর্তী প্রফিট ডিস্ট্রিবিউশনে ইনভেস্টররা আরও বেশি লাভবান হবেন।' }}
                </p>
            </div>

            <div class="relative z-10 md:w-1/3 text-left md:text-right">
                <a href="{{ route('register') }}" class="inline-block bg-transparent border-2 border-brand-red text-brand-red px-8 py-3 rounded-full font-bold hover:bg-brand-red hover:text-white transition">
                    আপডেটগুলো দেখুন
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. Our Portfolio / Track Record -->
<section id="portfolio" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-brand-black mb-3">আমাদের সফল প্রজেক্ট</h2>
        <div class="w-16 h-1 bg-brand-red mx-auto rounded-full mb-12"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($completedProjects as $project)
            @php
            $totalIncome = $project->finances->where('type', 'income')->sum('amount');
            $totalExpense = $project->finances->where('type', 'expense')->sum('amount');
            $netProfit = $totalIncome - $totalExpense;
            @endphp

            <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden border border-gray-100 text-left hover:shadow-md transition">
                @if($project->batch && $project->batch->image)
                <img src="{{ asset('storage/' . $project->batch->image) }}" class="w-full md:w-48 h-48 md:h-auto object-cover" alt="{{ $project->name }}">
                @else
                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=400&q=80" class="w-full md:w-48 h-48 md:h-auto object-cover" alt="Portfolio Default">
                @endif

                <div class="p-6 flex flex-col justify-center">
                    <span class="text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded mb-2 w-max">সম্পন্ন</span>
                    <h3 class="text-xl font-bold text-brand-black mb-2">{{ $project->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        {{ $project->batch ? Str::limit($project->batch->description, 60) : 'আমাদের একটি সফল বিনিয়োগ প্রজেক্ট।' }}
                    </p>
                    <p class="text-brand-red font-bold text-sm">নিট প্রফিট: ৳ {{ number_format($netProfit > 0 ? $netProfit : 0) }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-8">
                <p class="text-gray-500 text-lg mb-2">খুব শিগগিরই আমাদের সফল প্রজেক্টগুলোর তথ্য এখানে যুক্ত করা হবে।</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 6. Why Choose Us? -->
<section class="py-20 bg-brand-black text-brand-white border-b-4 border-brand-red">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-bold mb-4">কেন <span class="text-brand-red">SOURCE 365</span> বেস্ট?</h2>
                <div class="w-16 h-1 bg-brand-red rounded-full mb-8"></div>
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-brand-red/20 text-brand-red flex items-center justify-center mr-4 mt-1 shrink-0">✓</div>
                        <div>
                            <h4 class="text-xl font-bold mb-1">রিয়েল-টাইম ট্রান্সপারেন্সি</h4>
                            <p class="text-gray-400 text-sm">আপনার ড্যাশবোর্ডে প্রতিদিনের আয় এবং ব্যয়ের হিসাব দেখতে পাবেন。</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-brand-red/20 text-brand-red flex items-center justify-center mr-4 mt-1 shrink-0">✓</div>
                        <div>
                            <h4 class="text-xl font-bold mb-1">লিমিটেড ও সিকিউর ব্যাচ</h4>
                            <p class="text-gray-400 text-sm">প্রতিটি ব্যাচে শুধুমাত্র ২৫ জন সদস্য। ভিড় নেই, প্রফিট শেয়ারিং পরিষ্কার।</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-brand-red/20 text-brand-red flex items-center justify-center mr-4 mt-1 shrink-0">✓</div>
                        <div>
                            <h4 class="text-xl font-bold mb-1">অটোমেটেড প্রফিট ডিস্ট্রিবিউশন</h4>
                            <p class="text-gray-400 text-sm">সিস্টেম নিজে থেকেই প্রফিট হিসাব করে আপনার ওয়ালেটে পাঠিয়ে দেবে।</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2">
                <!-- আগে Unsplash এর লিংক ছিল, এখন এটি দিন -->
                <img src="{{ isset($settings['why_choose_image']) ? asset('storage/' . $settings['why_choose_image']) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80' }}" alt="Why Choose Us" class="rounded-2xl shadow-2xl border border-gray-800">
            </div>
        </div>
    </div>
</section>

<!-- 6.5 Our Tech Stack & Partners -->
<section class="py-12 bg-white border-y border-gray-100">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-xl font-bold text-gray-500 mb-6 uppercase tracking-wider">আমাদের ব্যবহৃত প্রযুক্তি ও পার্টনার</h3>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60">
            <div class="text-2xl font-bold text-gray-800">Laravel</div>
            <div class="text-2xl font-bold text-gray-800">MySQL</div>
            <div class="text-2xl font-bold text-gray-800">TailwindCSS</div>
            <div class="text-2xl font-bold text-gray-800">Chart.js</div>
            <div class="text-2xl font-bold text-gray-800">Beco Laboratories Unani</div>
        </div>
    </div>
</section>

<!-- 9. Contact & Location -->
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-brand-black mb-3">আমাদের অফিস লোকেশন</h2>
            <div class="w-16 h-1 bg-brand-red mx-auto rounded-full"></div>
            <p class="text-gray-500 mt-4">সরাসরি আমাদের অফিসে ভিজিট করুন অথবা ফোনে যোগাযোগ করুন</p>
        </div>

        <div class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100">
            <!-- Contact Info -->
            <div class="md:w-1/3 p-10 bg-brand-black text-white flex flex-col justify-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-red/20 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>

                <h3 class="text-2xl font-bold mb-8 relative z-10 flex items-center">
                    <span class="w-10 h-10 bg-brand-red rounded-full flex items-center justify-center mr-3 text-lg">📞</span>
                    যোগাযোগের ঠিকানা
                </h3>

                <div class="space-y-8 relative z-10">
                    <div>
                        <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">অফিসের ঠিকানা</p>
                        <p class="font-bold text-lg text-gray-100">Ashulia School & College Market, Ashulia, Savar, Dhaka.</p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">ফোন নাম্বার</p>
                        <p class="font-bold text-2xl text-brand-red">01408185023</p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider font-semibold">ইমেইল</p>
                        <p class="font-bold text-lg text-gray-100">contact@source365.org</p>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="md:w-2/3 h-80 md:h-auto min-h-[400px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d230.96353407900202!2d90.329739!3d23.8925398!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c24fc91b8991%3A0x6e9b2f4504f834d5!2sV8VH%2B2V9%2C%20Anwar%20Jang%20Sarak%2C%20Ashulia!5e1!3m2!1sen!2sbd!4v1791376201695!5m2!1sen!2sbd"
                    class="w-full h-full"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- 7. Testimonials -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-brand-black mb-3">গ্রাহকদের মতামত</h2>
        <div class="w-16 h-1 bg-brand-red mx-auto rounded-full mb-12"></div>

        <!-- টেস্টিমোনিয়াল গ্রিড -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
            @forelse($testimonials as $testimonial)
            <div class="bg-brand-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="text-brand-red text-3xl mb-2 leading-none">"</div>
                    <p class="text-gray-600 mb-6 italic text-sm">{{ $testimonial->text }}</p>
                </div>
                <div class="flex items-center">
                    @if($testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->author }}" class="w-12 h-12 rounded-full mr-3 object-cover shadow-sm border border-gray-200">
                    @else
                    <div class="w-12 h-12 bg-gray-200 rounded-full mr-3 flex items-center justify-center text-gray-500 font-bold">👤</div>
                    @endif
                    <div>
                        <h4 class="font-bold text-brand-black">{{ $testimonial->author }}</h4>
                        <p class="text-xs text-gray-500">{{ $testimonial->role }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">
                আমাদের সম্মানিত গ্রাহকদের মতামত খুব শিগগিরই এখানে যুক্ত করা হবে।
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 8. FAQ -->
<section class="py-20 bg-brand-white">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-brand-black mb-3">সাধারণ প্রশ্নসমূহ</h2>
            <div class="w-16 h-1 bg-brand-red mx-auto rounded-full"></div>
        </div>

        <div class="space-y-4">
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <h4 class="font-bold text-brand-black text-lg">বিনিয়োগের টাকা কীভাবে তোলা যাবে?</h4>
                <p class="text-gray-600 text-sm mt-2">আপনার ওয়ালেটে প্রফিট জমা হওয়ার পর উইথড্র রিকোয়েস্ট দিলে তা ব্যাংক বা মোবাইল ব্যাংকিংয়ে পাঠানো হবে।</p>
            </div>
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <h4 class="font-bold text-brand-black text-lg">একটি ব্যাচে ২৫ জনের বেশি যুক্ত হতে পারবে কি?</h4>
                <p class="text-gray-600 text-sm mt-2">না। আমাদের সিস্টেম স্বয়ংক্রিয়ভাবে ২৫ জন পূর্ণ হলে ব্যাচ লক করে দেয়।</p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <h4 class="font-bold text-brand-black text-lg">আমি কি একসাথে একাধিক ব্যাচে বিনিয়োগ করতে পারব?</h4>
                <p class="text-gray-600 text-sm mt-2">হ্যাঁ, আপনি চাইলে একই সাথে একাধিক চলমান ব্যাচে (যদি সেখানে সিট ফাঁকা থাকে) বিনিয়োগ করতে পারবেন। আপনার ড্যাশবোর্ডে প্রতিটি ব্যাচের হিসাব আলাদাভাবে দেখানো হবে।</p>
            </div>
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <h4 class="font-bold text-brand-black text-lg">প্রফিট কীভাবে বন্টন করা হয়?</h4>
                <p class="text-gray-600 text-sm mt-2">প্রজেক্ট থেকে প্রাপ্ত মোট আয় থেকে পরিচালন ব্যয় বাদ দেওয়ার পর যে "নিট প্রফিট" (Net Profit) থাকে, তা ব্যাচের ২৫ জন সদস্যের মাঝে সমানভাগে ভাগ করে দেওয়া হয়। পুরো প্রক্রিয়াটি আমাদের সিস্টেমে অটোমেটেড।</p>
            </div>
            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <h4 class="font-bold text-brand-black text-lg">কোম্পানির কোনো নির্দিষ্ট ফি বা হিডেন চার্জ আছে কি?</h4>
                <p class="text-gray-600 text-sm mt-2">না, আমাদের কোনো হিডেন চার্জ নেই। প্রজেক্ট পরিচালনার জন্য যে খরচ হয় তা সরাসরি ড্যাশবোর্ডে "Expense" হিসেবে দেখানো হয়। আমরা ১০০% স্বচ্ছতায় বিশ্বাসী।</p>
            </div>
        </div>
    </div>
</section>

@endsection