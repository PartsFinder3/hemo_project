<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SpareParts;
use App\Models\Blogs;
use App\Models\CarMakes;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public function index()
    {
        $host = request()->getHost(); // current domain

        // Common data
        $parts = SpareParts::all();
        $makes = CarMakes::all();

        // Domain-specific blogs
        $blogs = Blogs::whereHas('domain', function ($q) use ($host) {
            $q->where('domain_url', $host);
        })->get();

        return response()
            ->view('sitemap', compact('parts', 'makes', 'blogs'))
            ->header('Content-Type', 'application/xml');
    }
}
