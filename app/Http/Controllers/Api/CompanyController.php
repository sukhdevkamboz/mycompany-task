<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies = Company::where('user_id', auth()->id())->get();
            return response()->json($companies);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve companies',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        

       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'industry' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Invalid company details',
                    'errors' => $validator->errors()
                ], 401);
            }else{

                Company::create([
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'address' => $request->address,
                    'industry' =>  $request->industry,
                ]);
                return response()->json(['message' => 'Company created successfully.'], 201);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to create company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        //dd($id);
        try{
            $company = Company::where('user_id', auth()->id())->where('id',$id)->first();
            if(!$company){
                return response()->json(['message' => 'Company not found.'], 404);
            }
            return response()->json($company);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to get company',
                'error' => $e->getMessage()
            ], 500);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'industry' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Invalid company details',
                    'errors' => $validator->errors()
                ], 401);
            }else{
                $company = Company::where('user_id', auth()->id())->findOrFail($id);
                $company->update($request->only(['name', 'address', 'industry']));
                return response()->json(['message' => 'Company updated successfully.'], 200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to update company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try{
            $company = Company::where('user_id', auth()->id())->findOrFail($id);
            $company->delete();
            return response()->json(['message' => 'Company deleted successfully.'], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to delete company',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
