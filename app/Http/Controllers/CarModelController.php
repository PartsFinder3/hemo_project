<?php

namespace App\Http\Controllers;

use App\Models\CarMakes;
use App\Models\CarModels;
use Illuminate\Http\Request;
use Str;

class CarModelController extends Controller
{
public function index(Request $request)
{
    // Get per page from request, default 100
    
    // Get models with their makes, order by name, and paginate
   $models = CarModels::with('make')->orderBy('name', 'ASC')->paginate(100);

    // Get all makes for selection/dropdown
    $makes = CarMakes::orderBy('name', 'ASC')->get();

    return view('adminPanel.carModels.show', compact('models', 'makes'));
}


    public function create(Request $request)
    {
        $request->validate([
            'car_make_id' => 'required',
            'name' => 'required',
            'slug' => 'nullable',
            'year_start' => 'nullable|numeric',
            'year_end' => 'nullable|numeric'
        ]);

        $model = new CarModels();
        $model->car_make_id = $request->input('car_make_id');
        $model->name = $request->input('name');

        $slug = $request->input('slug') ?: Str::slug($request->input('name'));
        $model->slug = $this->makeSlugUnique($slug);

        $model->year_start = $request->input('year_start');
        $model->year_end = $request->input('year_end');

        $model->save();

        return redirect()->back()->with('success', "Model Added Successfully");
    }

    public function delete($id)
    {
        $model = CarModels::find($id);
        $model->delete();
        return redirect()->back()->with('success', 'Model Deleted Successfully');
    }

    public function edit($id)
    {
        $model = CarModels::find($id);
        $makes = CarMakes::all();
        return view('adminPanel.carModels.edit', compact('model', 'makes'));
    }

   public function update(Request $request, $id)
{
    $model = CarModels::find($id);
    if (!$model) {
        return redirect()->route('model.show')->with('error', 'Model Not Found');
    }

    $request->validate([
        'car_make_id' => 'required',
        'name' => 'required',
        'slug' => 'nullable',
        'year_start' => 'nullable|numeric',
        'year_end' => 'nullable|numeric'
    ]);

    $model->car_make_id = $request->input('car_make_id');
    $model->name = $request->input('name');

    // Update slug generation to ignore current model
    $slug = $request->input('slug') ?: Str::slug($request->input('name'));
    $model->slug = $this->makeSlugUnique($slug, $model->id); // Pass current model ID

    $model->year_start = $request->input('year_start');
    $model->year_end = $request->input('year_end');

    $model->save();

    return redirect()->route('model.show')->with('success', "Model Updated Successfully");
}

protected function makeSlugUnique($slug, $ignoreId = null)
{
    $original = $slug;
    $count = 1;

    $query = CarModels::where('slug', $slug);
    if ($ignoreId) {
        $query->where('id', '!=', $ignoreId);
    }

    while ($query->exists()) {
        $slug = $original . '-' . $count;
        $count++;

        $query = CarModels::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
    }

    return $slug;
}
public function search(Request $request)
{
   
    $search  = $request->input('search');

    $models = CarModels::with('make')
        ->when($search, function($query, $search){
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('make', function($q) use ($search) {
                      $q->where('name', 'LIKE', '%' . $search . '%');
                  });
        })
        ->orderBy('name', 'ASC')
    
        ->appends($request->query());

    $makes = CarMakes::orderBy('name', 'ASC')->get();

    return view('adminPanel.carModels.show', compact('models', 'makes', 'perPage'));
}
}
