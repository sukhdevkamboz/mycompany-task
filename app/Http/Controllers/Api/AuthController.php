<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        //dd("register");
         try {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            if ($validator->fails()) { 
                return response()->json([
                    'message' => 'Invalid registration details',
                    'errors' => $validator->errors()
                ], 401);
            }else{
            
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'access_token' => $token, 
                    'token_type' => 'Bearer', 
                ],201);
            }
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required'],
            ]);
            
            if ($validator->fails()) { 
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }else{
                $user = User::where('email', $request->email)->first();
                if (!$user || !Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'message' => 'Invalid login details'
                    ], 401);
                }
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token, 
                    'token_type' => 'Bearer',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'You have successfully logged out and the token was successfully deleted'
            ], 200);
        } catch (\Exception $e) {       
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
