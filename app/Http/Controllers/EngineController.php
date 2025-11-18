<?php

namespace App\Http\Controllers;

use App\Models\EngineSize;
use Illuminate\Http\Request;

class EngineController extends Controller
{
    public function index(){
        $engineSize = EngineSize::all();
        return view('adminPanel.engine.show',compact('engineSize'));
    }

    public function create(Request $request){
        $request->validate([
            'size' => 'required'
        ]);
        $engine = new EngineSize();
        $engine->size = $request->size;
        $engine->save();
        return redirect()->back()->with('success','Engine Size Added Successfully');
    }

    public function delete($id){
        $engine = EngineSize::find($id);
        $engine->delete();
        return redirect()->back()->with('success','Engine Size Added Successfully');
    }
}
