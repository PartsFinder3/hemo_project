<?php

namespace App\Http\Controllers;

use App\Models\SpareParts;
use App\Models\PartCategory;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SparePartsController extends Controller
{
public function index(Request $request)
{
    $perPage = $request->input('per_page', 100); // default 100
    $spareParts = SpareParts::with('category')
        ->orderBy('name', 'ASC')
        ->paginate($perPage);
      $sparePartD = SpareParts::all();
      foreach ($sparePartD as $part) {
        # code...
       echo  $part->name;
      }
    $categories = PartCategory::orderBy('name')->get();

    return view('adminPanel.parts.show', compact('spareParts', 'categories', 'perPage'));
}

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:part_category,id',
            'name' => 'required|string|max:255',
            'oem_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.webp';

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file)->toWebp(90);

            $path = storage_path('app/public/spareparts/' . $fileName);
            $image->save($path);

            $imagePath = 'spareparts/' . $fileName;
        }

        SpareParts::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'oem_number' => $request->oem_number,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Spare part added successfully!');
    }

    public function edit($id)
    {
        $sparePart = SpareParts::findOrFail($id);
        $categories = PartCategory::all();
        return view('adminPanel.parts.edit', compact('sparePart', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $sparePart = SpareParts::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:part_category,id',
            'name' => 'required|string|max:255',
            'oem_number' => 'nullable|string',
 
        ]);

        $imagePath = $sparePart->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.webp';

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file)->toWebp(90);

            $path = storage_path('app/public/spareparts/' . $fileName);
            $image->save($path);

            $imagePath = 'spareparts/' . $fileName;
        }

        $sparePart->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'oem_number' => $request->oem_number,
            'image' => $imagePath,
        ]);

        return redirect()->route('spareparts.show')->with('success', 'Spare part updated successfully!');
    }
    public function destroy($id)
    {
        $sparePart = SpareParts::findOrFail($id);
        $sparePart->delete();
        return redirect()->back()->with('success', 'Spare part deleted successfully!');
    }
}
