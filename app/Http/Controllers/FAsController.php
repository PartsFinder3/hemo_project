<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FAsController extends Controller
{
    //\

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
