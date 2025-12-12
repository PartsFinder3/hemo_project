<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SpareParts;
use App\Models\Blogs;
use App\Models\CarMakes;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Shops;
use App\Models\City;
class SiteMapController extends Controller
{
    public function index()
    {
            $domain = Domain::first();
                $blogs = $domain->blogs()->latest()->get();
                $parts = SpareParts::all();
                $makes = CarMakes::all();
                $shops = Shops::where('is_active', 1)->get();
                $city =City::all();
        return response()
            ->view('sitemap', compact('parts', 'makes', 'blogs','shops','city'))
            ->header('Content-Type', 'application/xml');
    }
}
