<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
          // nampilin kamarnya,yang akses admi
          $kamar = Kamar::all();
          return $kamar;
    }


    public function store(Request $request)
    {
        //tambah data kamar
        $table = Kamar::create([
            "nama_kamar" => $request->nama_kamar,
            "fasilitas_kamar" => $request->fasilitas_kamar,
            "kuantitas_kamar" => $request->kuantitas_kamar,
            "harga_kamar" => $request->harga_kamar
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'data kamar berhasil disimpan',
            'data' => $table
        ], 201);
    }

    public function show($id)
    {
        //menampilkan data kamar
        $kamar = Kamar::find($id);
        if($kamar){
            return response()->json([
                'status' => 200,
                'data' => $kamar
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id atas ' . $id . 'tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
         //mengubah data kamar
         $kamar = Kamar::find($id);
         if($kamar){
             $kamar->nama_kamar = $request->nama_kamar ? $request->nama_kamar : $kamar->nama_kamar;
             $kamar->fasilitas_kamar = $request->fasilitas_kamar ? $request->fasilitas_kamar : $kamar->fasilitas_kamar;
             $kamar->kuantitas_kamar = $request->kuantitas_kamar ? $request->kuantitas_kamar : $kamar->kuantitas_kamar;
             $kamar->harga_kamar = $request->harga_kamar ? $request->harga_kamar : $kamar->harga_kamar;
             $kamar->save();
             return response()->json([
 
                 'status' => 200,
                 'data' => $kamar
             ], 200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ],404);
         }
    }

    public function destroy($id)
    {
        //menghapus data kamar
        $kamar = Kamar::where('id',$id )->first();
        if($kamar){
            $kamar->delete();
            return response()->json([
                'status' => 200,
                'data' => $kamar
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => $id . 'tidak ditemukan'
            ],404);
        }
    }
}
