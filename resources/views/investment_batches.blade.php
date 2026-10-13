@extends('layouts.app')

@section('content')

<!-- 1. Hero Section -->
<section class="relative py-20 bg-brand-black text-center">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-black via-brand-black/90 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <span class="inline-block py-1 px-3 border border-brand-red text-brand-red font-bold rounded-full text-sm mb-4 bg-brand-red/10">স্মার্ট বিনিয়োগ</span>
        <h1 class="text-4xl md:text-5xl font-bold text-brand-white mb-4">আমাদের <span class="text-brand-red">বিনিয়োগ ব্যাচসমূহ</span></h1>
        <div class="w-16 h-1 bg-brand-red mx-auto rounded-full mb-6"></div>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg leading-relaxed">
            নিচে আমাদের বর্তমান রানিং প্রজেক্টগুলোর তালিকা দেওয়া হলো। প্রতিটি ব্যাচে শুধুমাত্র ২৫ জন সদস্য নেওয়ার পর অটোমেটিকভাবে ব্যাচটি লক হয়ে যায়।
        </p>
    </div>
</section>

<!-- 2. Security & Trust Section (নিরাপত্তার গ্যারান্টি) -->
<section class="py-16 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-brand-black">আপনার বিনিয়োগ কতটা নিরাপদ?</h2>
            <p class="text-gray-600 mt-2">SOURCE 365-এ আপনার ফান্ডের সর্বোচ্চ নিরাপত্তা ও স্বচ্ছতা নিশ্চিত করতে আমরা বদ্ধপরিকর।</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="text-brand-red text-4xl">🛡️</div>
                <div>
                    <h4 class="font-bold text-brand-black text-xl mb-2">১০০% স্বচ্ছতা ও ট্র্যাকিং</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">আপনার টাকা ঠিক কোন প্রজেক্টে, কোন খাতে খরচ হচ্ছে এবং প্রতিদিন কত টাকা লাভ হচ্ছে— তার পাই-টু-পাই হিসাব আপনি আপনার ড্যাশবোর্ডে দেখতে পাবেন। কোনো হিডেন চার্জ বা লুকোচুরি নেই।</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="text-brand-red text-4xl">⚖️</div>
                <div>
                    <h4 class="font-bold text-brand-black text-xl mb-2">লিমিটেড রিক্স ম্যানেজমেন্ট</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">আমরা এমন প্রজেক্টেই হাত দেই যার বাস্তব অস্তিত্ব আছে (যেমন- বাস নামানো, ওয়্যারহাউস দেওয়া)। প্রতিটি ব্যাচ শুধুমাত্র ২৫ জনের মধ্যে সীমাবদ্ধ, তাই অতিরিক্ত ফান্ডিংয়ের কোনো রিস্ক নেই।</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="text-brand-red text-4xl">🔐</div>
                <div>
                    <h4 class="font-bold text-brand-black text-xl mb-2">সুরক্ষিত পেমেন্ট ও ফান্ডিং</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">ইনভেস্টরদের সমস্ত ফান্ডিং সিস্টেমের মাধ্যমে মনিটর করা হয় এবং প্রফিট ডিস্ট্রিবিউশন সিস্টেম পুরোপুরি অটোমেটেড। আপনার টাকা আপনার ওয়ালেটে সুরক্ষিত থাকে।</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="text-brand-red text-4xl">🤝</div>
                <div>
                    <h4 class="font-bold text-brand-black text-xl mb-2">সরাসরি মালিকানা</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">২৫ জনের ফান্ড কমপ্লিট হওয়ার পর প্রজেক্টের সম্পূর্ণ মালিকানা ইনভেস্টরদের থাকে। অ্যাডমিন শুধুমাত্র প্রজেক্টটি পরিচালনা করে এবং নির্দিষ্ট লভ্যাংশ সিস্টেমে এন্ট্রি করে।</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Dynamic Batches Section (ডায়নামিক ডাটাবেস থেকে) -->
<section class="py-20 bg-brand-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-brand-black mb-2">ইনভেস্টমেন্টের জন্য প্রস্তুত ব্যাচ</h2>
                <div class="w-16 h-1 bg-brand-red rounded-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($openBatches as $batch)
            <!-- Dynamic Batch Card -->
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl hover:border-brand-red transition duration-300">
                <div class="h-48 relative overflow-hidden bg-gray-200">
                    @if($batch->image)
                        <img src="{{ asset('storage/' . $batch->image) }}" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="{{ $batch->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Default Project Image">
                    @endif
                    <span class="absolute top-4 right-4 bg-brand-red text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow">Open</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-brand-black mb-2">{{ $batch->name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ $batch->description }}</p>
                    
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                        <span class="text-gray-600 font-semibold text-sm">বিনিয়োগ (জনপ্রতি):</span>
                        <span class="text-brand-red font-bold text-xl">৳ {{ number_format($batch->investment_amount) }}</span>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex justify-between text-sm mb-1 font-bold">
                            <span class="text-gray-600">যুক্ত হয়েছেন</span>
                            <span class="text-brand-black">{{ $batch->joined_members }} / {{ $batch->max_members }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            @php $progress = ($batch->joined_members / $batch->max_members) * 100; @endphp
                            <div class="bg-brand-red h-2 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    
                    @auth
                        <form action="{{ route('batch.join', $batch->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত? ওয়ালেট থেকে ৳{{ number_format($batch->investment_amount) }} কেটে নেওয়া হবে।');">
                            @csrf
                            <button type="submit" class="w-full bg-brand-black text-white font-bold py-3 rounded-xl hover:bg-brand-red transition duration-300 shadow">
                                ব্যাচে জয়েন করুন
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-center w-full border-2 border-gray-300 text-gray-700 font-bold py-2.5 rounded-xl hover:bg-gray-100 transition">
                            জয়েন করতে লগইন করুন
                        </a>
                    @endauth
                </div>
            </div>
            @empty
            <!-- যদি কোনো ব্যাচ ওপেন না থাকে -->
            <div class="col-span-3 text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <div class="text-5xl mb-4">📭</div>
                <h3 class="text-2xl font-bold text-brand-black mb-2">বর্তমানে কোনো নতুন ব্যাচ নেই!</h3>
                <p class="text-gray-500 text-lg">আমাদের রানিং প্রজেক্টগুলোর ২৫ জনের কোটা পূরণ হয়ে গেছে। খুব শিগগিরই নতুন প্রজেক্ট ও ব্যাচ নিয়ে আসা হবে। সাথে থাকার জন্য ধন্যবাদ!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection