<?php

namespace App\Http\Controllers;

use App\Movie;
use Validator;
use Illuminate\Http\Request;
class MovieController extends Controller
{
    public function get()
    {
        $data = Movie::get();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($id)
    {
        $data = Movie::find($id);

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required|file',
            'nama_pemain' => 'required',
            'sinopsis' => 'required',
            'user_rate' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $file = $request->file('gambar')->store('movies');

        $data = new Movie;
        $data->judul = $request->judul;
        $data->nama_pemain = $request->nama_pemain;
        $data->gambar = $file;
        $data->sinopsis = $request->sinopsis;
        $data->user_rate = $request->user_rate;
        $data->save();

        return response()->json([
            'messages' => 'success created movie'
        ], 200);

    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required|file',
            'nama_pemain' => 'required',
            'sinopsis' => 'required',
            'user_rate' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $file = $request->file('gambar')->store('movies');

        $data = Movie::find($id);
        $data->judul = $request->judul;
        $data->nama_pemain = $request->nama_pemain;
        $data->gambar = $file;
        $data->sinopsis = $request->sinopsis;
        $data->user_rate = $request->user_rate;
        $data->save();

        return response()->json([
            'messages' => 'success updated movie'
        ], 200);
    }

    public function delete($id)
    {
        Movie::find($id)->delete();

        return response()->json([
            'status' => 'success delete movie'
        ], 200);
    }


}
