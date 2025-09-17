<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserActiveCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserActiveCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'company_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Invalid company details',
                    'errors' => $validator->errors()
                ], 401);
            }else{

                $company = UserActiveCompany::where('user_id', auth()->id())->where('company_id',$request->company_id)->first();

                if($company){
                    return response()->json([
                        'message' => 'Active company already exists',
                    ], 401);
                }

                $data = [
                        'user_id' => auth()->id(),
                        'company_id' => $request->company_id,
                        
                    ];
                
                UserActiveCompany::create($data);
                return response()->json(['message' => 'Active Company added successfully.'], 201);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to add active company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserActiveCompany $userActiveCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserActiveCompany $userActiveCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserActiveCompany $userActiveCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       try{
            $company = UserActiveCompany::where('user_id', auth()->id())->where('company_id',$id)->first();
            $company->delete();
            return response()->json(['message' => 'Active Company removed successfully.'], 200);
       }catch(\Exception $e){
            return response()->json([
                'message' => 'Failed to remove active company',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
