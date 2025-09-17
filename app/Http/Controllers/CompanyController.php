<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('userActiveCompany')->where('user_id', auth()->id())->get();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        Company::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'address' => $request->address,
            'industry' => $request->industry,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $company = Company::where('user_id', auth()->id())->findOrFail($company->id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        $company = Company::where('user_id', auth()->id())->findOrFail($company->id);
        $company->update([
            'name' => $request->name,
            'address' => $request->address,
            'industry' => $request->industry,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company = Company::where('user_id', auth()->id())->findOrFail($company->id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
