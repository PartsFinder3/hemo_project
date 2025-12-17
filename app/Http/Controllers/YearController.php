<?php

namespace App\Http\Controllers;

use App\Models\Years;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index(){
        $years = Years::paginate(100);
        return view('adminPanel.years.show',compact('years'));
    }

    public function create(Request $request){
        $request->validate([
            'year' => 'numeric|required',
        ]);
        $years = new Years();
        $years->year = $request->year;
        $years->save();
        return redirect()->back()->with('success','Year Added Successfully');
    }

    public function delete($id){
        Years::find($id)->delete();
        return redirect()->back()->with('success','Year Deleted Successfully');
    }

    public function search(Request $request){
    $search = $request->q;
    $years = Years::where('year', 'like', "%{$search}%")->paginate(100);
    return view('adminPanel.years.show', compact('years'));
}
}
