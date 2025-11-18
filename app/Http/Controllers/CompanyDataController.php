<?php

namespace App\Http\Controllers;

use App\Models\CompanyData;
use App\Models\Domain;
use Illuminate\Http\Request;

class CompanyDataController extends Controller
{
    public function index()
    {
        $domains = Domain::all();
        $companyData = CompanyData::all();
        return view('adminPanel.company.about', compact('domains', 'companyData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'about_us' => 'required|string',
            'terms_conditions' => 'required|string',
            'privacy_policy' => 'required|string',
        ]);

        CompanyData::create($request->all());

        return redirect()->back()->with('success', 'Company data saved successfully.');
    }

    public function edit($id)
    {
        $companyData = CompanyData::findOrFail($id);
        $domains = Domain::all();
        return view('adminPanel.company.edit', compact('companyData', 'domains'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'about_us' => 'required|string',
            'terms_conditions' => 'required|string',
            'privacy_policy' => 'required|string',
        ]);

        $companyData = CompanyData::findOrFail($id);
        $companyData->update($request->all());

        return redirect()->route('company.about')->with('success', 'Company data updated successfully.');
    }

    public function destroy($id)
    {
        $companyData = CompanyData::findOrFail($id);
        $companyData->delete();

        return redirect()->back()->with('success', 'Company data deleted successfully.');
    }
}
