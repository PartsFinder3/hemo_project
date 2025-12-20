<?php

namespace App\Http\Controllers;

use App\Models\CarMakes;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\SeoContentMake;

use Str;


class CarMakeController extends Controller
{
    public function index(Request $request)
    {
        
        $perPage = $request->input('per_page', 100);

        $carMakes = CarMakes::orderBy('name', 'ASC')->paginate($perPage);

        $totalMakes = CarMakes::count();

        return view('adminPanel.makes.show', compact('carMakes', 'perPage', 'totalMakes'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $carMake = new CarMakes();
        $logo_name = null; // ✅ initialize

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . '.webp';

            $manager = new ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );

            $image = $manager->read($logo)->toWebp(90);
            $path = storage_path('app/public/logo/' . $logo_name);
            $image->save($path);
        }

        $carMake->name = $request->input('name');
        $carMake->logo = $logo_name ? 'logo/' . $logo_name : null; // ✅ safe assignment
        $carMake->slug = \Illuminate\Support\Str::slug($carMake->name);
        $carMake->save();

        return redirect()->back()->with('success', 'Car Make Added Successfully');
    }


    public function delete($id)
    {
        $carMake = CarMakes::find($id);
        $carMake->delete();
        return redirect()->back()->with('success', 'Car Make Deleted Successfully');
    }

    public function update($id)
    {
        $carMake = CarMakes::find($id);
        return view('adminPanel.makes.edit', compact('carMake'));
    }

    public function edit(Request $request, $id)
    {
        $carMake = CarMakes::find($id);
        if (!$carMake) {
            return redirect()->back()->with('error', 'Car Make Not Found');
        }
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|mimes:jpg,jpeg,png'
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . '.webp';
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($logo)->toWebp(90);
            $path = storage_path('app/public/logo/' . $logo_name);
            $image->save($path);
            $carMake->logo = 'logo/' . $logo_name;
        }
        $carMake->name = $request->input('name');
        $carMake->slug = \Illuminate\Support\Str::slug($carMake->name);
        $carMake->save();
        return redirect()->route('makes.show')->with('success', 'Car Make Updated Successfully');
    }
}
