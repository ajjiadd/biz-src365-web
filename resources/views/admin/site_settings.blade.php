@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-bold">{{ session('success') }}</div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-brand-black">হোমপেজ ও সাইট সেটিংস</h2>
        <p class="text-gray-500 text-sm mt-1">এখান থেকে হোমপেজের টেক্সট, ছবি এবং টেস্টিমোনিয়াল আপডেট করুন।</p>
    </div>

    <!-- enctype="multipart/form-data" যুক্ত করা হয়েছে ফাইল আপলোডের জন্য -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. Hero Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">হিরো সেকশন (Banner)</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">সাব-টাইটেল</label>
                    <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? 'স্মার্ট বিনিয়োগ, নিশ্চিত ভবিষ্যৎ' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">মূল টাইটেল</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '২৫ জনের এক্সক্লুসিভ বিনিয়োগ ব্যাচ' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">বিস্তারিত (Description)</label>
                    <textarea name="hero_desc" rows="3" class="w-full border p-2 rounded">{{ $settings['hero_desc'] ?? 'SOURCE 365 এর মাধ্যমে নিরাপদ প্রজেক্টে...' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">ব্যানার ব্যাকগ্রাউন্ড ছবি</label>
                    <input type="file" name="hero_bg_image" class="w-full border p-2 rounded bg-gray-50">
                    @if(isset($settings['hero_bg_image']))
                        <img src="{{ asset('storage/' . $settings['hero_bg_image']) }}" class="h-16 mt-2 rounded">
                    @endif
                </div>
            </div>
        </div>

        <!-- 2. Statistics Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">স্ট্যাটিস্টিক্স (Trust Bar)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">সফল প্রজেক্ট</label>
                    <input type="text" name="stat_projects" value="{{ $settings['stat_projects'] ?? '১২+' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">মোট বিনিয়োগকারী</label>
                    <input type="text" name="stat_investors" value="{{ $settings['stat_investors'] ?? '৩০০+' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">মোট প্রফিট ডিস্ট্রিবিউশন</label>
                    <input type="text" name="stat_profit" value="{{ $settings['stat_profit'] ?? '৳ 5M+' }}" class="w-full border p-2 rounded">
                </div>
            </div>
        </div>

        <!-- 3. Announcements -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">নতুন আপডেট (Announcement)</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">আপডেট টাইটেল</label>
                    <input type="text" name="announcement_title" value="{{ $settings['announcement_title'] ?? 'নতুন আপডেট সম্পন্ন!' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">আপডেট বিস্তারিত</label>
                    <textarea name="announcement_desc" rows="3" class="w-full border p-2 rounded">{{ $settings['announcement_desc'] ?? 'বিস্তারিত লিখুন...' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 4. Why Choose Us Image -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">'কেন আমরা বেস্ট' সেকশনের ছবি</h3>
            <div>
                <input type="file" name="why_choose_image" class="w-full border p-2 rounded bg-gray-50">
                @if(isset($settings['why_choose_image']))
                    <img src="{{ asset('storage/' . $settings['why_choose_image']) }}" class="h-20 mt-2 rounded">
                @endif
            </div>
        </div>

        <!-- 5. Testimonial (গ্রাহকের মতামত) -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">গ্রাহকদের মতামত (Testimonial)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">গ্রাহকের মন্তব্য</label>
                    <textarea name="testimonial_text" rows="3" class="w-full border p-2 rounded">{{ $settings['testimonial_text'] ?? 'SOURCE 365 এর ড্যাশবোর্ড খুবই ক্লিয়ার...' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">গ্রাহকের নাম</label>
                    <input type="text" name="testimonial_author" value="{{ $settings['testimonial_author'] ?? 'রহিম উদ্দিন' }}" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">গ্রাহকের পেশা/ব্যাচ</label>
                    <input type="text" name="testimonial_role" value="{{ $settings['testimonial_role'] ?? 'বিনিয়োগকারী, ব্যাচ-০১' }}" class="w-full border p-2 rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">গ্রাহকের ছবি</label>
                    <input type="file" name="testimonial_image" class="w-full border p-2 rounded bg-gray-50">
                    @if(isset($settings['testimonial_image']))
                        <img src="{{ asset('storage/' . $settings['testimonial_image']) }}" class="h-16 mt-2 rounded-full w-16 object-cover">
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="bg-brand-black text-white px-8 py-3 rounded-lg font-bold hover:bg-brand-red transition w-full">সব পরিবর্তন সেভ করুন</button>
    </form>
@endsection