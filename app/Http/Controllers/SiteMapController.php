<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SpareParts;
use App\Models\Blogs;
use App\Models\CarMakes;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Shops;

class SiteMapController extends Controller
{
    public function index()
    {
            $domain = Domain::first();
                $blogs = $domain->blogs()->latest()->get();
                $parts = SpareParts::all();
                $makes = CarMakes::all();
                $shops = Shops::where('is_active', 1)->get();

        return response()
            ->view('sitemap', compact('parts', 'makes', 'blogs','shops'))
            ->header('Content-Type', 'application/xml');
    }
}
