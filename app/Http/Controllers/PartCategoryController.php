<?php

namespace App\Http\Controllers;

use App\Models\PartCategory;
use Illuminate\Http\Request;

class PartCategoryController extends Controller
{
    public function index(){
        $category = PartCategory::all();
        return view('adminPanel.partsCategory.show', compact('category'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $category = new PartCategory();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->back()->with('success','Category Added Successfully');
    }

    public function delete($id){
        $category = PartCategory::find($id); 
        $category->delete();
        return redirect()->back()->with('success','Category Deleted Successfully');
    }
}
