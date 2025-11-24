<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::latest()->get();
        return view('adminPanel.domain.show', compact('domains'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'domain_url' => 'required',
            'about' => 'required',
            'logo' => 'required|mimes:jpg,jpeg,png,webp',
            'map_img' => 'required|mimes:jpg,jpeg,png,webp',
        ]);

        $domian = new Domain();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . '.webp';

            $manager = new ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );

            $image = $manager->read($logo)->toWebp(90);

            $path = storage_path('storage/logo/' . $logo_name);
            $image->save($path);
        }

        if ($request->hasFile('map_img')) {
            $map_img = $request->file('map_img');
            $map_img_name = time() . '_map.webp';

            $manager = new ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );

            $image = $manager->read($map_img)->toWebp(90);

            $path = storage_path('stoarge/logo/' . $map_img_name);
            $image->save($path);
        }

        $domian->name = $request->name;
        $domian->domain_url = $request->domain_url;
        $domian->about = $request->about;
        $domian->logo = 'logo/' . $logo_name;
        $domian->map_img = 'logo/' . $map_img_name;
        $domian->save();

        return redirect()->back()->with('success', 'Domain Added Successfully');
    }


    public function delete($id)
    {
        $domain = Domain::find($id);
        if ($domain) {
            $domain->delete();
        }
        return redirect()->back()->with('success', 'Domain Deleted Successfully');
    }

    public function update($id)
    {
        $domain = Domain::find($id);
        if ($domain) {
            return view('adminPanel.domain.edit', compact('domain'));
        }
    }

 public function edit(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'domain_url' => 'required',
        'about' => 'required',
        'logo' => 'nullable|mimes:jpg,jpeg,png',
        'map_img' => 'nullable|mimes:jpg,jpeg,png',
    ]);

    $domain = Domain::find($id);
    if (!$domain) {
        return redirect()->route('domain.show')->with('error', 'Domain Not Found');
    }

    $domain->name = $request->name;
    $domain->domain_url = $request->domain_url;
    $domain->about = $request->about;

    // Handle logo
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logo_name = time() . '.webp';

        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read($logo)->toWebp(90);

        $path = storage_path('app/public/logo/' . $logo_name);
        $image->save($path);

        $domain->logo = 'logo/' . $logo_name;
    }

    // Handle map image
    if ($request->hasFile('map_img')) {
        $map_img = $request->file('map_img');
        $map_img_name = time() . '_map.webp';

        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read($map_img)->toWebp(90);

        $path = storage_path('app/public/logo/' . $map_img_name);
        $image->save($path);

        $domain->map_img = 'logo/' . $map_img_name;
    }

    $domain->save();

    return redirect()->route('domain.show')->with('success', 'Domain Updated Successfully');
}
  function data($id){
     $faqs = Faq::all();
      $domain_id=$id;
    return view('adminPanel.faqs.index', compact('faqs','domain_id'));
    
  }
public function store_faqs(Request $request)
{
    $request->validate([
        'question' => 'required',
        'answer'   => 'required',
       
    ]);

    $faq = Faq::create([
        'F_question' => $request->question,
        'F_answer'   => $request->answer,
         'domain_id' => $request->domain_id,
    ]);

    return response()->json([
        'code' => 1,
        'message' => 'FAQ Added Successfully',
        'data' => $faq
    ]);
}

public function destroy_fas($id)
{
    $faq = FAQ::findOrFail($id);
    $faq->delete();

    // Session flash message
    return back()->with('success', 'FAQ deleted successfully!');
}   
public function edit_faqs($id)
{
    $faq = Faq::findOrFail($id);
    return view('adminPanel.faqs.edit', compact('faq'));
}
public function update_faqs(Request $request, $id)
{
    $faq = Faq::findOrFail($id);

    $faq->F_question = $request->question;
    $faq->F_answer   = $request->answer;


    $faq->save();

    return redirect()->route('addFAQs.faqs', $faq->domain_id)
                     ->with('success', 'FAQ updated successfully!');
}
}

