<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // ১. সেটিংস পেজ লোড করা
    public function settings()
    {
        $user = Auth::user();
        return view('dashboard.settings', compact('user'));
    }

    // ২. প্রোফাইলের বেসিক তথ্য (নাম, ইমেইল) আপডেট করা
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'আপনার প্রোফাইলের তথ্য সফলভাবে আপডেট হয়েছে।');
    }

    // ৩. পাসওয়ার্ড পরিবর্তন করার লজিক
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // confirmed এর জন্য new_password_confirmation ফিল্ড লাগবে
        ]);

        $user = Auth::user();

        // বর্তমান পাসওয়ার্ড সঠিক কি না চেক করা
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'আপনার বর্তমান পাসওয়ার্ডটি সঠিক নয়!');
        }

        // নতুন পাসওয়ার্ড পুরোনো পাসওয়ার্ডের মতো কি না চেক করা
        if (Hash::check($request->new_password, $user->password)) {
            return back()->with('error', 'নতুন পাসওয়ার্ড এবং পুরোনো পাসওয়ার্ড একই হতে পারবে না!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }
}