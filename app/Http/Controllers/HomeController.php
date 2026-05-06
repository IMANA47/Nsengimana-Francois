<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Services\SectionManager;

class HomeController extends Controller
{
    public function __invoke(SectionManager $sectionManager)
    {
        $data = [
            'projects' => Project::latest()->take(6)->get(),
            'certificates' => Certificate::latest()->take(6)->get(),
            'testimonials' => Testimonial::latest()->take(6)->get(),
            'skills' => Skill::orderBy('sort_order')->get()->groupBy('category'),
            'experiences' => Experience::orderByDesc('start_date')->get(),
            'services' => Service::orderBy('sort_order')->get(),
            'sections' => $sectionManager->enabledSections(),
            'profile' => config('portfolio.profile'),
            'seo' => config('portfolio.seo'),
        ];

        return view('home', $data);
    }
}
