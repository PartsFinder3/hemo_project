<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index(){
        $fuel = Fuel::all();
        return view('adminPanel.fuel.show',compact('fuel'));
    }

    public function create(Request $request){
        $request->validate([
            'type' => 'required',
        ]);
        $fuel =  new Fuel();
        $fuel->type = $request->type;
        $fuel->save();
        return redirect()->back()->with('success','Fuel type added successfully');
    }

    public function delete($id){
        $fuel = Fuel::find($id);
        $fuel->delete();
        return redirect()->back()->with('success','Fuel type deleted successfully');
    }
}
