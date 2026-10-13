<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Testimonial; // এই মডেলটি এখানে যুক্ত করতে হবে

class HomeController extends Controller
{
    public function index()
    {
        $openBatches = Batch::where('status', 'open')->latest()->get();
        $completedProjects = Project::where('status', 'completed')->with(['batch', 'finances'])->latest()->take(4)->get();
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        // টেস্টিমোনিয়াল ফেচ করা
        $testimonials = Testimonial::latest()->get();

        return view('welcome', compact('openBatches', 'completedProjects', 'settings', 'testimonials'));
    }

    // About Us পেজ লোড করা
    public function about()
    {
        return view('about');
    }

    // How It Works পেজ লোড করা
    public function howItWorks()
    {
        return view('how_it_works');
    }

    // বিনিয়োগ ব্যাচসমূহ পেজ লোড করা
    public function investmentBatches()
    {
        $openBatches = Batch::where('status', 'open')->latest()->get();
        return view('investment_batches', compact('openBatches'));
    }

    // পোর্টফোলিও পেজ লোড করা
    public function portfolio()
    {
        $completedProjects = Project::where('status', 'completed')
            ->with(['batch', 'finances'])
            ->latest()
            ->get();

        return view('portfolio', compact('completedProjects'));
    }

    // প্রাইভেসি পলিসি পেজ
    public function privacyPolicy()
    {
        return view('privacy');
    }

    // টার্মস অফ সার্ভিস পেজ
    public function termsOfService()
    {
        return view('terms');
    }
}