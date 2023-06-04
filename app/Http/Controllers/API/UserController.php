<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         
        return response()->json(
            [
                "data" => [
                    "status" => true,
                    "messasge" => "success",
                    "data" => $user
                ]
            ]
        );

    }

    public function login (Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
            return response()->json([
                'message' => 'creadential not match',
                'status' => false
            ]);
        }
        else{
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken($user->name)->accessToken;
            return response()->json([
                'status' => true,
                'users' => Auth::user(),
                'token' => $token 
            ]);
        }       
    }

  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        
        $token = $user->createToken($user->name)->accessToken;
        $user->token = $token; 
        return response()->json(
            [
                "data" => [
                    "status" => true,
                    "messasge" => "success",
                    "data" => $user
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
