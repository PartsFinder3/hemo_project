<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        $domains = Domain::all();
        return view('adminPanel.cities.show', compact('cities','domains'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'domain_id' => 'required',
        ]);
        $city = new City();
        $city->name = $request->input('name');
        $city->domain_id = $request->input('domain_id');
        $city->slug = Str::slug($city->name);
        $city->save();
        return redirect()->back()->with('success', 'City created successfully');
    }

    public function delete($id){
        $city = City::find($id);
        $city->delete();
        return redirect()->back()->with('success', 'City deleted successfully');
    }

    public function activetoogle($id){
        $city = City::find($id);
        $city->active = $city->active == 1 ? 0 : 1;
        $city->save();
        return redirect()->back()->with('success', 'City status updated successfully');
    }
}
