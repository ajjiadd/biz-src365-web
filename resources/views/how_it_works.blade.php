@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 bg-brand-black text-center">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-black via-brand-black/90 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold text-brand-white mb-4">কীভাবে <span class="text-brand-red">কাজ করে?</span></h1>
        <div class="w-16 h-1 bg-brand-red mx-auto rounded-full mb-6"></div>
        <p class="text-gray-300 max-w-3xl mx-auto text-lg leading-relaxed">
            SOURCE 365 প্ল্যাটফর্মে বিনিয়োগ করা অত্যন্ত সহজ এবং সম্পূর্ণ নিরাপদ। ট্রান্সপারেন্সি বা স্বচ্ছতাকে অগ্রাধিকার দিয়ে আমরা পুরো প্রক্রিয়াটিকে ৫টি সহজ ধাপে সাজিয়েছি।
        </p>
    </div>
</section>

<!-- Step-by-Step Details Section -->
<section class="py-20 bg-brand-white">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <div class="space-y-12">
            <!-- Step 1 -->
            <div class="flex flex-col md:flex-row items-center gap-8 bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:border-brand-red transition duration-300 shadow-sm">
                <div class="w-20 h-20 shrink-0 bg-brand-red text-white text-3xl font-bold rounded-full flex items-center justify-center shadow-lg">১</div>
                <div>
                    <h3 class="text-2xl font-bold text-brand-black mb-3">ফ্রি রেজিস্ট্রেশন ও ফান্ড অ্যাড</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        প্রথমেই SOURCE 365-এ একটি ফ্রি অ্যাকাউন্ট তৈরি করুন। এরপর আপনার ড্যাশবোর্ডের "ওয়ালেট ও লেনদেন" সেকশন থেকে বিকাশ, নগদ বা ব্যাংক ট্রান্সফারের মাধ্যমে আপনার অ্যাকাউন্টে ফান্ড বা ব্যালেন্স যুক্ত করুন। অ্যাডমিন আপনার পেমেন্ট ভেরিফাই করার সাথে সাথেই ওয়ালেটে টাকা যুক্ত হয়ে যাবে।
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col md:flex-row-reverse items-center gap-8 bg-white p-8 rounded-2xl border border-gray-100 hover:border-brand-red transition duration-300 shadow-sm">
                <div class="w-20 h-20 shrink-0 bg-brand-black text-brand-red text-3xl font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-brand-red">২</div>
                <div class="text-left md:text-right">
                    <h3 class="text-2xl font-bold text-brand-black mb-3">পছন্দের ব্যাচ নির্বাচন ও বিনিয়োগ</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        আমাদের ড্যাশবোর্ডে বিভিন্ন রিয়েল-ওয়ার্ল্ড প্রজেক্টের (যেমন- ট্রান্সপোর্ট, ই-কমার্স) "ওপেন ব্যাচ" দেখতে পাবেন। প্রতিটি ব্যাচে <strong class="text-brand-black">সর্বোচ্চ ২৫ জন</strong> যুক্ত হতে পারবেন। ব্যাচের বিস্তারিত, বিনিয়োগের পরিমাণ এবং সম্ভাব্য প্রফিট দেখে আপনার পছন্দের ব্যাচে এক ক্লিকেই জয়েন করুন।
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col md:flex-row items-center gap-8 bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:border-brand-red transition duration-300 shadow-sm">
                <div class="w-20 h-20 shrink-0 bg-brand-red text-white text-3xl font-bold rounded-full flex items-center justify-center shadow-lg">৩</div>
                <div>
                    <h3 class="text-2xl font-bold text-brand-black mb-3">প্রজেক্ট পরিচালনা ও ১০০% স্বচ্ছতা</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        ব্যাচে ২৫ জন পূর্ণ হলে ফান্ডটি সরাসরি প্রজেক্টে ইনভেস্ট করা হয়। প্রজেক্ট শুরু হওয়ার পর প্রতিদিনের আয় এবং ব্যয়ের হিসাব ড্যাশবোর্ডে আপডেট করা হয়। আপনি আপনার "আমার ব্যাচসমূহ" এবং "ওয়ালেট" পেজ থেকে রিয়েল-টাইম গ্রাফ এবং হিস্ট্রির মাধ্যমে দেখতে পারবেন প্রজেক্টটি কেমন চলছে।
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="flex flex-col md:flex-row-reverse items-center gap-8 bg-white p-8 rounded-2xl border border-gray-100 hover:border-brand-red transition duration-300 shadow-sm">
                <div class="w-20 h-20 shrink-0 bg-brand-black text-brand-red text-3xl font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-brand-red">৪</div>
                <div class="text-left md:text-right">
                    <h3 class="text-2xl font-bold text-brand-black mb-3">স্বয়ংক্রিয় প্রফিট ডিস্ট্রিবিউশন</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        প্রজেক্ট থেকে অর্জিত নিট প্রফিট (আয় - ব্যয়) নির্দিষ্ট সময় পর পর ব্যাচের সকল ইনভেস্টরদের মাঝে সমানভাগে বন্টন করা হয়। আমাদের অটোমেটেড সিস্টেম নিজে থেকেই হিসাব করে আপনার ওয়ালেটে প্রফিটের টাকা পাঠিয়ে দিবে।
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="flex flex-col md:flex-row items-center gap-8 bg-brand-red/5 p-8 rounded-2xl border border-brand-red transition duration-300 shadow-md">
                <div class="w-20 h-20 shrink-0 bg-brand-red text-white text-3xl font-bold rounded-full flex items-center justify-center shadow-lg">৫</div>
                <div>
                    <h3 class="text-2xl font-bold text-brand-black mb-3">যেকোনো সময় উইথড্র</h3>
                    <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                        আপনার ওয়ালেটে জমা হওয়া প্রফিট বা মূলধনের টাকা যেকোনো সময় উইথড্র করতে পারবেন। ড্যাশবোর্ড থেকে উইথড্র রিকোয়েস্ট দিলে খুব দ্রুততম সময়ের মধ্যে আপনার দেওয়া মোবাইল ব্যাংকিং (বিকাশ/নগদ) বা ব্যাংক অ্যাকাউন্টে টাকা পাঠিয়ে দেওয়া হবে।
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <h3 class="text-2xl font-bold text-brand-black mb-6">পুরো প্রক্রিয়াটি বুঝতে পেরেছেন?</h3>
            <a href="{{ route('register') }}" class="inline-block bg-brand-red text-brand-white px-10 py-4 rounded-full text-lg font-bold hover:bg-red-700 transition shadow-[0_0_20px_rgba(255,0,0,0.3)]">
                আজই আপনার অ্যাকাউন্ট তৈরি করুন
            </a>
        </div>

    </div>
</section>

@endsection