<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoTamplate;
use App\Models\SpareParts;
use App\Models\CarMakes;
use App\Models\CarModels;
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
        public function assign_tamp_parts(Request $request, $id)
        {
            $parts = SpareParts::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;
            $parts->save();

            return back()->with('success', 'Template successfully assigned!');
        }
        function assign_tamp_make($id){
           $parts = CarMakes::findOrFail($id);

              $getTamp = $parts->tamp_id 
        ? SeoTamplate::find($parts->tamp_id) 
        : null;
          $allTemplte = SeoTamplate::all();
          return view('adminPanel.partsMeta.make', compact('getTamp', 'allTemplte','parts'));
        }
                public function assign_tamp_make_post(Request $request, $id)
        {
            $parts = CarMakes::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;
            $parts->save();

            return back()->with('success', 'Template successfully assigned!');
        }
         function assign_tamp_model($id){
           $parts = CarModels::findOrFail($id);

              $getTamp = $parts->tamp_id 
        ? SeoTamplate::find($parts->tamp_id) 
        : null;
          $allTemplte = SeoTamplate::all();
          return view('adminPanel.partsMeta.model', compact('getTamp', 'allTemplte','parts'));
        }
           public function assign_tamp_model_post(Request $request, $id)
        {
            $parts = CarModels::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;
            $parts->save();

            return back()->with('success', 'Template successfully assigned!');
        }
}
