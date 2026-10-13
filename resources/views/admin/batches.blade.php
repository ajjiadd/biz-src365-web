@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-brand-black">ব্যাচ ম্যানেজমেন্ট</h2>
        <button onclick="document.getElementById('createBatchModal').classList.remove('hidden')" class="bg-brand-black text-brand-white px-4 py-2 rounded-lg font-bold hover:bg-brand-red transition">
            + নতুন ব্যাচ তৈরি করুন
        </button>
    </div>

    <!-- ব্যাচের তালিকা -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">ছবি</th>
                    <th class="p-4 border-b">ব্যাচের নাম</th>
                    <th class="p-4 border-b">বিনিয়োগ (জনপ্রতি)</th>
                    <th class="p-4 border-b">স্ট্যাটাস</th>
                    <th class="p-4 border-b text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($batches as $batch)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">
                        @if($batch->image)
                            <img src="{{ asset('storage/' . $batch->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                        @else
                            <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500 shadow-sm">No Image</div>
                        @endif
                    </td>
                    <td class="p-4 border-b">
                        <span class="font-bold text-brand-black">{{ $batch->name }}</span>
                        <span class="block text-xs text-gray-500 mt-1">মেম্বারস: {{ $batch->joined_members }} / {{ $batch->max_members }}</span>
                    </td>
                    <td class="p-4 border-b font-bold text-brand-black">৳ {{ number_format($batch->investment_amount) }}</td>
                    <td class="p-4 border-b">
                        <form action="{{ route('admin.batches.status', $batch->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded p-1.5 text-sm focus:outline-none focus:border-brand-red cursor-pointer">
                                <option value="open" {{ $batch->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="funding" {{ $batch->status == 'funding' ? 'selected' : '' }}>Funding</option>
                                <option value="active" {{ $batch->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="closed" {{ $batch->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                    <td class="p-4 border-b text-right flex justify-end space-x-2">
                        <!-- Edit Button -->
                        <button onclick="document.getElementById('editBatchModal{{ $batch->id }}').classList.remove('hidden')" class="bg-blue-500 text-white px-3 py-1.5 rounded text-sm font-bold hover:bg-blue-600 transition">এডিট</button>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('admin.batches.delete', $batch->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ব্যাচটি সম্পূর্ণ ডিলিট করতে চান?');">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-sm font-bold hover:bg-red-600 transition">ডিলিট</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Batch Modal for this specific batch -->
                <div id="editBatchModal{{ $batch->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
                    <div class="bg-white rounded-lg p-8 max-w-lg w-full relative">
                        <button onclick="document.getElementById('editBatchModal{{ $batch->id }}').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
                        <h2 class="text-2xl font-bold mb-6 text-brand-black">ব্যাচ এডিট করুন</h2>
                        
                        <form action="{{ route('admin.batches.update', $batch->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold mb-1">ব্যাচের নাম</label>
                                <input type="text" name="name" value="{{ $batch->name }}" required class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold mb-1">বিনিয়োগ (৳)</label>
                                    <input type="number" name="investment_amount" value="{{ $batch->investment_amount }}" required class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold mb-1">সর্বোচ্চ মেম্বার</label>
                                    <input type="number" name="max_members" value="{{ $batch->max_members }}" required class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-1">প্রজেক্টের ছবি (ঐচ্ছিক)</label>
                                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-brand-red">
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-1">ব্যাচের বিবরণ</label>
                                <textarea name="description" required rows="3" class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">{{ $batch->description }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded mt-4 hover:bg-blue-700 transition">আপডেট করুন</button>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">কোনো ব্যাচ তৈরি করা হয়নি।</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Create Batch Modal -->
    <div id="createBatchModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto pt-10 pb-10">
        <div class="bg-white rounded-lg p-8 max-w-lg w-full relative">
            <button onclick="document.getElementById('createBatchModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <h2 class="text-2xl font-bold mb-6 text-brand-black">নতুন ব্যাচ তৈরি করুন</h2>
            
            <form action="{{ route('admin.batches.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold mb-1">ব্যাচের নাম</label>
                    <input type="text" name="name" required placeholder="যেমন: বাস প্রজেক্ট - ২" class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">বিনিয়োগ (জনপ্রতি ৳)</label>
                        <input type="number" name="investment_amount" required placeholder="যেমন: 50000" class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">সর্বোচ্চ মেম্বার</label>
                        <input type="number" name="max_members" required value="25" class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">প্রজেক্টের ছবি (Banner Image)</label>
                    <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-brand-red">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">ব্যাচের বিবরণ</label>
                    <textarea name="description" required rows="3" placeholder="প্রজেক্ট সম্পর্কে বিস্তারিত লিখুন..." class="w-full border border-gray-300 p-2.5 rounded focus:outline-none focus:border-brand-red"></textarea>
                </div>
                <button type="submit" class="w-full bg-brand-red text-white font-bold py-3 rounded mt-4 hover:bg-red-700 transition">ব্যাচ তৈরি করুন</button>
            </form>
        </div>
    </div>
@endsection