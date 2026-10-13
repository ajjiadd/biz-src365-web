@extends('layouts.dashboard')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 font-bold shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 font-bold shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-brand-black">আমার ব্যাচসমূহ 💼</h2>
        <p class="text-gray-500 text-sm mt-1">আপনার বিনিয়োগকৃত সব ব্যাচ এবং নতুন বিনিয়োগের সুযোগ এক জায়গায়।</p>
    </div>

    <!-- সেকশন ১: আমার বিনিয়োগকৃত ব্যাচসমূহ -->
    <div class="mb-12">
        <div class="flex items-center mb-6">
            <h3 class="text-xl font-bold text-brand-black border-l-4 border-brand-red pl-3">আমার বিনিয়োগ</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($myBatches as $batch)
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300">
                    <div class="h-40 relative bg-gray-200">
                        @if($batch->image)
                            <img src="{{ asset('storage/' . $batch->image) }}" class="w-full h-full object-cover" alt="{{ $batch->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Default Image">
                        @endif
                        <span class="absolute top-3 right-3 bg-brand-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow">
                            {{ $batch->status }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-brand-black mb-2">{{ $batch->name }}</h4>
                        <div class="bg-green-50 rounded-lg p-3 mb-4 border border-green-100">
                            <span class="block text-xs text-green-700 font-bold mb-1">আপনার বিনিয়োগ:</span>
                            <span class="text-xl font-bold text-green-700">৳ {{ number_format($batch->pivot->invested_amount ?? $batch->investment_amount) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm border-t border-gray-100 pt-4">
                            <span class="text-gray-500">প্রজেক্ট স্ট্যাটাস:</span>
                            <span class="font-bold text-brand-black">
                                {{ $batch->project ? ucfirst($batch->project->status) : 'Pending' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-sm mt-2">
                            <span class="text-gray-500">বর্তমান প্রফিট:</span>
                            <span class="font-bold {{ ($batch->project && $batch->project->net_profit > 0) ? 'text-green-600' : 'text-gray-400' }}">
                                ৳ {{ number_format($batch->project->net_profit ?? 0) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-gray-50 border border-dashed border-gray-300 rounded-2xl p-8 text-center">
                    <div class="text-4xl mb-3">📭</div>
                    <h4 class="text-lg font-bold text-gray-700">আপনি এখনো কোনো ব্যাচে বিনিয়োগ করেননি</h4>
                    <p class="text-sm text-gray-500 mt-1">নিচের তালিকা থেকে আপনার পছন্দের ব্যাচটি নির্বাচন করে আজই বিনিয়োগ শুরু করুন।</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- সেকশন ২: নতুন ব্যাচে বিনিয়োগ করুন (Open Batches) -->
    <div>
        <div class="flex items-center mb-6">
            <h3 class="text-xl font-bold text-brand-black border-l-4 border-brand-red pl-3">নতুন ব্যাচে বিনিয়োগ করুন</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($availableBatches as $batch)
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-red transition duration-300 flex flex-col">
                    <div class="h-40 relative bg-gray-200">
                        @if($batch->image)
                            <img src="{{ asset('storage/' . $batch->image) }}" class="w-full h-full object-cover" alt="{{ $batch->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover" alt="Default Image">
                        @endif
                        <span class="absolute top-3 right-3 bg-brand-red text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow">
                            Open
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h4 class="text-lg font-bold text-brand-black mb-1">{{ $batch->name }}</h4>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $batch->description }}</p>
                        
                        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                            <span class="text-gray-600 text-sm font-bold">বিনিয়োগ (জনপ্রতি):</span>
                            <span class="text-brand-red font-bold text-lg">৳ {{ number_format($batch->investment_amount) }}</span>
                        </div>
                        
                        <div class="mb-6 flex-1">
                            <div class="flex justify-between text-xs mb-1 font-bold">
                                <span class="text-gray-500">যুক্ত হয়েছেন</span>
                                <span class="text-brand-black">{{ $batch->joined_members }} / {{ $batch->max_members }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                @php $progress = ($batch->joined_members / $batch->max_members) * 100; @endphp
                                <div class="bg-brand-red h-2 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                        
                        <form action="{{ route('batch.join', $batch->id) }}" method="POST" onsubmit="return confirm('আপনি কি এই ব্যাচে বিনিয়োগ করতে ইচ্ছুক? আপনার ওয়ালেট থেকে ৳{{ number_format($batch->investment_amount) }} কাটা হবে।');">
                            @csrf
                            <button type="submit" class="w-full bg-brand-black text-white font-bold py-3 rounded-xl hover:bg-brand-red transition duration-300 shadow-md">
                                জয়েন করুন
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 bg-brand-white rounded-2xl border border-gray-100">
                    <p class="text-gray-500 text-lg">বর্তমানে জয়েন করার মতো কোনো নতুন ব্যাচ ওপেন নেই।</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection