<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoTamplate;
class SeoController extends Controller
{
    //
    function index(){
        $Tamplates=SeoTamplate::all();
        return view('adminPanel.seo_tamplate.index',compact('Tamplates'));
    }
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
          
        ]);

        // Save to database
        $base = new SeoTamplate;
        $base->title = $validated['title'];
        $base->description = $validated['description'];
     
        $base->save();

        return redirect()->back()->with('success', 'SEO Template added successfully!');
    }
        public function update($id)
        {
            $Tamplate = SeoTamplate::findOrFail($id); // findOrFail recommended
            return view('adminPanel.seo_tamplate.eid', compact('Tamplate'));
        }
        // Delete function
    public function destroy($id)
    {
        $seoTemplate = SeoTamplate::findOrFail($id);
        $seoTemplate->delete();

        return redirect()->route('SEO.dashboard')->with('success', 'Template deleted successfully!');
    }
    function updateTamp(Request $request,$id){
        $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
              
            ]);

            $seoTemplate = SeoTamplate::findOrFail($id);
            $seoTemplate->title = $validated['title'];
            $seoTemplate->description = $validated['description'];
          
            $seoTemplate->save();

        return redirect()->route('SEO.dashboard')->with('success', 'Template updated successfully!');
    }
    
}
