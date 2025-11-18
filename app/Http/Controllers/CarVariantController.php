<?php

namespace App\Http\Controllers;

use App\Models\CarModels;
use App\Models\CarVarients;
use App\Models\EngineSize;
use App\Models\Fuel;
use Illuminate\Http\Request;

class CarVariantController extends Controller
{
    public function index($id){
        $varients = CarVarients::where('car_model_id',$id)->get();
        return view('adminPanel.varients.show',compact('varients'));
    }

    public function showCreatePage($id){
        $model = CarModels::find($id);
        $fuel = Fuel::all();
        $engine = EngineSize::all();
        return view('adminPanel.varients.create',compact('model','fuel','engine'));
    }

    public function create(Request $request,$id){
        $model = CarModels::find($id);
        $carModelID = $model->id;
        $request->validate([
            'name' => 'required',
            'fuel_id' => 'required',
            'engine_size_id' => 'required',
            'transmission' => 'required'
        ]);
        $varient = new CarVarients();
        $varient->name = $request->input('name');
        $varient->car_model_id = $carModelID;
        $varient->fuel_id = $request->input('fuel_id');
        $varient->engine_size_id = $request->input('engine_size_id');
        $varient->transmission = $request->input('transmission');
        $varient->save();

        return redirect()->back()->with('success','Varient Added Successfully');
    }

    public function edit($id)
{
    $variant = CarVarients::findOrFail($id);
    $fuels = Fuel::all();
    $engineSizes = EngineSize::all();

    return view('adminPanel.varients.edit', compact('variant', 'fuels', 'engineSizes'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'fuel_id' => 'required',
        'engine_size_id' => 'required',
        'transmission' => 'required'
    ]);

    $variant = CarVarients::findOrFail($id);
    $variant->name = $request->input('name');
    $variant->fuel_id = $request->input('fuel_id');
    $variant->engine_size_id = $request->input('engine_size_id');
    $variant->transmission = $request->input('transmission');
    $variant->save();

    return redirect()->route('varient.show',$variant->car_model_id)->with('success', 'Variant Updated Successfully');
}

public function delete($id){
    $variant = CarVarients::findOrFail($id);
    $variant->delete();
    return redirect()->back()->with('success','Variant Deleted');
}

}
