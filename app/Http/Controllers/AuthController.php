<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|unique:users',
            'name' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'messages' => 'Invalid Field'
            ], 422);
        }

        $dataInput = array(
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->city
        );

        $data = User::create($dataInput);

        $credentials = $request->only(['username', 'password']);

        $token = Auth::attempt($credentials);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'messages' => 'Invalid Field'
            ], 422);
        }

        $credentials = $request->only(['username', 'password']);
        $token = Auth::attempt($credentials);
        if($token){
            return $this->respondWithToken($token);
        }else{
            return response()->json([
                'messages' => 'unAuthicated User'
            ], 401);
        }
        
    }
}
