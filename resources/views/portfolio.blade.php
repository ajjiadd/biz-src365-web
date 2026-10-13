@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 bg-brand-black text-center">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-black via-brand-black/90 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <span class="inline-block py-1 px-3 border border-brand-red text-brand-red font-bold rounded-full text-sm mb-4 bg-brand-red/10">সফলতার গল্প</span>
        <h1 class="text-4xl md:text-5xl font-bold text-brand-white mb-4">আমাদের <span class="text-brand-red">পোর্টফোলিও</span></h1>
        <div class="w-16 h-1 bg-brand-red mx-auto rounded-full mb-6"></div>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg leading-relaxed">
            আমরা শুধু প্রতিশ্রুতি দিই না, কাজ করে প্রমাণ করতে ভালোবাসি। নিচে আমাদের সফলভাবে সম্পন্ন হওয়া প্রজেক্টগুলোর বাস্তব হিসাব তুলে ধরা হলো। নিজের চোখেই দেখে নিন আমাদের ইনভেস্টররা কেমন প্রফিট পেয়েছেন।
        </p>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section class="py-20 bg-brand-white border-b border-gray-100">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">
            @forelse($completedProjects as $project)
                @php
                    // প্রজেক্টের ইনভেস্টমেন্ট এবং প্রফিট ক্যালকুলেশন
                    $totalIncome = $project->finances->where('type', 'income')->sum('amount');
                    $totalExpense = $project->finances->where('type', 'expense')->sum('amount');
                    $netProfit = $totalIncome - $totalExpense;
                    
                    $totalInvestment = $project->batch ? ($project->batch->investment_amount * $project->batch->joined_members) : 0;
                    $perUserProfit = ($project->batch && $project->batch->joined_members > 0 && $netProfit > 0) 
                                     ? ($netProfit / $project->batch->joined_members) 
                                     : 0;
                @endphp
                
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="h-64 relative bg-gray-200 overflow-hidden">
                        @if($project->batch && $project->batch->image)
                            <img src="{{ asset('storage/' . $project->batch->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $project->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Portfolio Default">
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                            <div>
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow mb-2 inline-block">সফলভাবে সম্পন্ন</span>
                                <h3 class="text-2xl font-bold text-white">{{ $project->name }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                            {{ $project->batch ? $project->batch->description : 'এই প্রজেক্টটি আমাদের দক্ষ টিমের পরিচালনায় সফলভাবে সম্পন্ন হয়েছে এবং বিনিয়োগকারীদের মাঝে প্রফিট বন্টন করা হয়েছে।' }}
                        </p>
                        
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <h4 class="text-brand-black font-bold mb-4 border-b border-gray-200 pb-2">প্রজেক্টের বাস্তব হিসাব:</h4>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">মোট বিনিয়োগ:</span>
                                    <span class="font-bold text-brand-black">৳ {{ number_format($totalInvestment) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">সিস্টেমে মোট আয়:</span>
                                    <span class="font-bold text-blue-600">৳ {{ number_format($totalIncome) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">প্রজেক্ট পরিচালন ব্যয়:</span>
                                    <span class="font-bold text-brand-red">- ৳ {{ number_format($totalExpense) }}</span>
                                </div>
                                <div class="border-t border-dashed border-gray-300 pt-3 flex justify-between items-center">
                                    <span class="text-gray-800 font-bold">মোট নিট প্রফিট:</span>
                                    <span class="font-bold text-green-600 text-lg">৳ {{ number_format($netProfit > 0 ? $netProfit : 0) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between bg-brand-red/5 p-4 rounded-xl border border-brand-red/20">
                            <div class="flex items-center gap-3">
                                <div class="text-3xl">💸</div>
                                <div>
                                    <p class="text-xs text-gray-500 font-bold">জনপ্রতি প্রফিট পেয়েছেন</p>
                                    <p class="text-brand-red font-bold text-xl">৳ {{ number_format($perUserProfit) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <div class="text-6xl mb-4">🌱</div>
                    <h3 class="text-3xl font-bold text-brand-black mb-3">আমাদের প্রজেক্টগুলো বর্তমানে চলমান</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                        আমাদের রানিং প্রজেক্টগুলোর কাজ অত্যন্ত সফলভাবে এগিয়ে চলছে। প্রজেক্টগুলোর মেয়াদ শেষ হলেই সেগুলোর সম্পূর্ণ হিসাব ও প্রফিটের ডাটা এখানে প্রকাশ করা হবে। 
                    </p>
                    <a href="{{ route('investment_batches') }}" class="inline-block bg-brand-black text-white px-8 py-3 rounded-xl font-bold hover:bg-brand-red transition">আমাদের চলমান ব্যাচগুলো দেখুন</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50 text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-brand-black mb-4">আপনিও কি আমাদের পরবর্তী সফলতার অংশ হতে চান?</h2>
        <p class="text-gray-600 mb-8 max-w-xl mx-auto">সঠিক জায়গায় বিনিয়োগ করুন। ১০০% স্বচ্ছতা এবং অটোমেটেড সিস্টেমের মাধ্যমে আপনার বিনিয়োগের হিসাব রাখুন নিজের হাতের মুঠোয়।</p>
        <a href="{{ route('investment_batches') }}" class="inline-block bg-brand-red text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-red-700 transition shadow-lg">আজই নতুন ব্যাচে জয়েন করুন</a>
    </div>
</section>

@endsection