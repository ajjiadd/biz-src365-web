@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-bold">{{ session('success') }}</div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-brand-black">গ্রাহকের মতামত ম্যানেজমেন্ট</h2>
    </div>

    <!-- টেস্টিমোনিয়াল অ্যাড করার ফর্ম -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-8">
        <h3 class="text-lg font-bold border-b pb-2 mb-4 text-brand-red">নতুন মতামত যুক্ত করুন</h3>
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-1">গ্রাহকের নাম</label>
                    <input type="text" name="author" required class="w-full border p-2 rounded focus:border-brand-red">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">পেশা বা ব্যাচ</label>
                    <input type="text" name="role" required class="w-full border p-2 rounded focus:border-brand-red">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-1">মতামত (Text)</label>
                    <textarea name="text" rows="3" required class="w-full border p-2 rounded focus:border-brand-red"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">গ্রাহকের ছবি (ঐচ্ছিক)</label>
                    <input type="file" name="image" class="w-full border p-2 rounded bg-gray-50">
                </div>
            </div>
            <button type="submit" class="bg-brand-black text-white px-6 py-2 rounded font-bold hover:bg-brand-red transition">যুক্ত করুন</button>
        </form>
    </div>

    <!-- টেস্টিমোনিয়াল লিস্ট -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 border-b">ছবি</th>
                    <th class="p-4 border-b">নাম ও পেশা</th>
                    <th class="p-4 border-b">মতামত</th>
                    <th class="p-4 border-b">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $item)
                <tr>
                    <td class="p-4 border-b">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">👤</div>
                        @endif
                    </td>
                    <td class="p-4 border-b">
                        <div class="font-bold text-brand-black">{{ $item->author }}</div>
                        <div class="text-xs text-gray-500">{{ $item->role }}</div>
                    </td>
                    <td class="p-4 border-b text-sm text-gray-600 w-1/2">{{ $item->text }}</td>
                    <td class="p-4 border-b">
                        <form action="{{ route('admin.testimonials.delete', $item->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত?');">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection