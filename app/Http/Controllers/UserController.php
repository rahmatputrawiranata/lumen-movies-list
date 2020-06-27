<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function detail()
    {
        $data = User::find(Auth::user()->id);

        return response()->json($data);
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',   
        ]);
        

        if($validator->fails()){
            return response()->json([
                'messages' => 'Invalid Field'
            ], 422);
        }

        $edit = User::find(Auth::user()->id);
        $edit->name = $request->name;
        $edit->address = $request->address;
        $edit->city = $request->city;
        $edit->province = $request->province;
        $edit->save();

        return response()->json([
            'status' => 'success edit user'
        ], 200);
    }
}
