<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoTamplate;
use App\Models\SpareParts;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\City;
use App\Models\SeoTitle;
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
           
            'description' => 'required|string',
             'template_description_type'=>'required'
        ]);

        // Save to database
        $base = new SeoTamplate;
        $base->type = $validated['template_description_type'];
        
        $base->description = $validated['description'];
     
        $base->save();

        return redirect()->back()->with('success', 'SEO Template Description added successfully!');
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

        return redirect()->route('SEO.dashboard')->with('success', 'Template description deleted successfully!');
    }
    function updateTamp(Request $request,$id){
        $validated = $request->validate([
              
                'description' => 'required|string',
                'template_description_type' => 'required',
              
            ]);

            $seoTemplate = SeoTamplate::findOrFail($id);
            $seoTemplate->type = $validated['template_description_type'];
            $seoTemplate->description = $validated['description'];
          
            $seoTemplate->save();

        return redirect()->route('SEO.dashboard')->with('success', 'Template updated desription successfully!');
    }  
        public function assign_tamp_parts(Request $request, $id)
        {
            $parts = SpareParts::findOrFail($id);

            // Save Description Template
            $parts->tamp_id = $request->seo_template_id;
        
            $parts->tamp_title_id = $request->title_template_id;

            $parts->save();
        

            return back()->with('success', 'Templates successfully assigned!');
        }
        public function assign_tamp_make($id)
        {
            $parts = CarMakes::findOrFail($id);
                    
            // Get assigned Title Template
            $getTitle = $parts->tamp_title_id 
                ? SeoTitle::find($parts->tamp_title_id) 
                : null;
             
            // Get assigned Description Template
            $getTamp = $parts->tamp_id 
                ? SeoTamplate::find($parts->tamp_id) 
                : null;

            // All description templates
            $allTemplte = SeoTamplate::where('type', 'makes')->get();

            // All title templates
            $allTitle = SeoTitle::where('type', 'makes')->get();

            return view(
                'adminPanel.partsMeta.make',
                compact('getTamp', 'allTemplte', 'parts', 'getTitle', 'allTitle')
            );
        }
         public function assign_tamp_city($id)
        {
            $parts = City::findOrFail($id);
                    
            // Get assigned Title Template
            $getTitle = $parts->tamp_title_id 
                ? SeoTitle::find($parts->tamp_title_id) 
                : null;
             
            // Get assigned Description Template
            $getTamp = $parts->tamp_id 
                ? SeoTamplate::find($parts->tamp_id) 
                : null;
           dd($getTitle->tittle);
            // All description templates
            $allTemplte = SeoTamplate::where('type', 'city')->get();

            // All title templates
            $allTitle = SeoTitle::where('type', 'city')->get();

            return view(
                'adminPanel.partsMeta.city',
                compact('getTamp', 'allTemplte', 'parts', 'getTitle', 'allTitle')
            );
        }

                public function assign_tamp_make_post(Request $request, $id)
        {
            $parts = CarMakes::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;


            $parts->tamp_title_id = $request->title_template_id;
            $parts->save();
         
            return back()->with('success', 'Template successfully assigned!');
        }
        function assign_tamp_city_post(Request $request,$id){
              $parts = City::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;


            $parts->tamp_title_id = $request->title_template_id;
            $parts->save();
         
            return back()->with('success', 'Template successfully assigned!');
         }

        public function assign_tamp_model($id)
{
    $parts = CarModels::findOrFail($id);

    // Get assigned Title Template
    $getTitle = $parts->tamp_title_id
        ? SeoTitle::find($parts->tamp_title_id)
        : null;

    // Get assigned Description Template
    $getTamp = $parts->tamp_id
        ? SeoTamplate::find($parts->tamp_id)
        : null;

    // All description templates (only for models)
    $allTemplte = SeoTamplate::where('type', 'models')->get();

    // All title templates (only for models)
    $allTitle = SeoTitle::where('type', 'models')->get();
    
    return view(
        'adminPanel.partsMeta.model',
        compact('getTamp', 'allTemplte', 'parts', 'getTitle', 'allTitle')
    );
}

           public function assign_tamp_model_post(Request $request, $id)
        {
            $parts = CarModels::findOrFail($id);
            $parts->tamp_id = $request->seo_template_id;
            $parts->tamp_title_id = $request->title_template_id;
            $parts->save();

            return back()->with('success', 'Template successfully assigned!');
        }
        function SeoTitles(){
            $titles=SeoTitle::all();
            return view('adminPanel.seo_tamplate.tittle',['titls'=>$titles]);
        }

          public function store_title(Request $request)
    {
        // Validation
        $validated = $request->validate([
           
            'title' => 'required|string',
             'template_description_type'=>'required'
        ]);

   
        $base = new SeoTitle;
        $base->type = $validated['template_description_type'];
        
        $base->tittle = $validated['title'];
     
        $base->save();

        return redirect()->back()->with('success', 'SEO Template title added successfully!');
    }
        public function destroy_title($id)
    {
        $seoTemplate = SeoTitle::findOrFail($id);
        $seoTemplate->delete();

        return redirect()->route('SEO.SeoTitles')->with('success', 'Template title deleted successfully!');
    }
            public function update_title($id)
        {
            $Tamplate_title = SeoTitle::findOrFail($id); // findOrFail recommended
            return view('adminPanel.seo_tamplate.update_title', compact('Tamplate_title'));
        }
        function updatetitle(Request $request,$id){
        $validated = $request->validate([
              
                'title' => 'required|string',
                'template_description_type' => 'required',
              
            ]);

            $seoTemplate = SeoTitle::findOrFail($id);
            $seoTemplate->type = $validated['template_description_type'];
            $seoTemplate->tittle = $validated['title'];
          
            $seoTemplate->save();

        return redirect()->route('SEO.SeoTitles')->with('success', 'Template updated desription successfully!');
    }  
}
