<?php

namespace App\Http\Controllers;

use App\Models\AdUnits;
use App\Models\PartsMeta;
use App\Models\SciteScripts;
use App\Models\MetaTags;
use App\Models\Domain;
use App\Models\SpareParts;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function index()
    {
        $scripts = SciteScripts::all();
        return view('adminPanel.scripts.index', compact('scripts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'script_content' => 'required|string',
        ]);

        SciteScripts::create([
            'type' => $request->type,
            'script_content' => $request->script_content,
        ]);

        return redirect()->back()->with('success', 'Script added successfully.');
    }

    public function destroy($id)
    {
        $script = SciteScripts::findOrFail($id);
        $script->delete();

        return redirect()->back()->with('success', 'Script deleted successfully.');
    }

    public function edit($id)
    {
        $script = SciteScripts::findOrFail($id);

        return view('adminPanel.scripts.edit', compact('script'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'script_content' => 'required|string',
        ]);

        $script = SciteScripts::findOrFail($id);
        $script->update([
            'type' => $request->type,
            'script_content' => $request->script_content,
        ]);

        return redirect()->route('admin.scripts.index')->with('success', 'Script updated successfully.');
    }

    public function adunit()
    {
        $adunits = AdUnits::all();
        return view('adminPanel.scripts.ad', compact('adunits'));
    }

    public function adunitstore(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'slot_id' => 'required|string',
            'client_id' => 'required|string',
        ]);

        AdUnits::create([
            'location' => $request->location,
            'slot_id' => $request->slot_id,
            'client_id' => $request->client_id,
        ]);

        return redirect()->back()->with('success', 'Ad Unit added successfully.');
    }

    public function adunitedit($id)
    {
        $adunit = AdUnits::findOrFail($id);

        return view('adminPanel.scripts.adedit', compact('adunit'));
    }

    public function adunitupdate(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string',
            'slot_id' => 'required|string',
            'client_id' => 'required|string',
        ]);

        $adunit = AdUnits::findOrFail($id);
        $adunit->update([
            'location' => $request->location,
            'slot_id' => $request->slot_id,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('admin.scripts.adunit')->with('success', 'Ad Unit updated successfully.');
    }

    public function adunitdestroy($id)
    {
        $adunit = AdUnits::findOrFail($id);
        $adunit->delete();

        return redirect()->back()->with('success', 'Ad Unit deleted successfully.');
    }

    public function metatags()
    {
        $metatags = MetaTags::all();
        $domains = Domain::all();
        return view('adminPanel.meta.index', compact('metatags','domains'));
    }

    public function metatagsstore(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'domain_id' => 'required|exists:domains,id',
        ]);

        MetaTags::create([
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'domain_id' => $request->domain_id,
        ]);

        return redirect()->back()->with('success', 'Meta Tags added successfully.');
    }

    public function metatagsdestroy($id)
    {
        $metatag = MetaTags::findOrFail($id);
        $metatag->delete();

        return redirect()->back()->with('success', 'Meta Tags deleted successfully.');
    }

    public function partsMeta($id){
        $parts = SpareParts::findOrFail($id);
        $domains = Domain::all();
        $metaParts =  PartsMeta::all();
        return view('adminPanel.partsMeta.index',compact('parts','domains','metaParts'));
    }

    public function storePartsMeta(Request $request,$id){
       $part = SpareParts::findOrFail($id);
       $partID = $part->id;
       $metaParts = new PartsMeta();
       $metaParts->title = $request->title;
       $metaParts->description = $request->description;
       $metaParts->focus_keywords = $request->focus_keywords;
       $metaParts->structure_data = $request->structure_data;
       $metaParts->part_id = $partID;
       $metaParts->domain_id = $request->domain_id;
       $metaParts->save();
       return redirect()->back()->with('success', 'Parts Meta added successfully.');
    }

    public function destroyPartsMeta($id)
    {
        $metaParts = PartsMeta::findOrFail($id);
        $metaParts->delete();

        return redirect()->back()->with('success', 'Parts Meta deleted successfully.');
    }


    public function editPartsMeta($id)
    {
        $metaParts = PartsMeta::findOrFail($id);
        $domains = Domain::all();
        return view('adminPanel.partsMeta.edit', compact('metaParts', 'domains'));
    }

    public function updatePartsMeta(Request $request, $id)
    {
        $metaParts = PartsMeta::findOrFail($id);
        $metaParts->update([
            'title' => $request->title,
            'description' => $request->description,
            'focus_keywords' => $request->focus_keywords,
            'structure_data' => $request->structure_data,
            'domain_id' => $request->domain_id,
        ]);

        return redirect()->route('admin.parts.meta',$metaParts->part_id)->with('success', 'Parts Meta updated successfully.');
    }
    
}
