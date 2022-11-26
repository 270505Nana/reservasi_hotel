<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        // nampilin data reservasi - admin
        $reservasi_nana = Reservasi::all();
        return $reservasi_nana;
    }

    public function store(Request $request)
    {
         //tambah reservasi - costumer
         $table = Reservasi::create([
            "nama_customer" => $request->nama_customer,
            "no_hp" => $request->no_hp,
            "jumlah_orang" => $request->jumlah_orang,
            "nama_kamar" => $request->nama_kamar,
            "tanggal_reservasi" => $request->tanggal_reservasi,
            "tanggal_kepulangan" => $request->tanggal_kepulangan,
            "jumlah_hari" => $request->jumlah_hari,
            "harga_kamar" => $request->harga_kamar,
            "total" => $request->total,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'data kamar berhasil disimpan',
            'data' => $table
        ], 201);
    }


    public function show($id)
    {
         //menampilkan detail reservasi - admin & costumer
         $reservasi_nana = Reservasi::find($id);
         if($reservasi_nana){
             return response()->json([
                 'status' => 200,
                 'data' => $reservasi_nana
             ], 200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ], 404);
         }
    }

    public function update(Request $request, $id)
    {
         //mengubah reservasi kamar - admin
         $reservasi_nana = Reservasi::find($id);
         if($reservasi_nana){
             $reservasi_nana->nama_customer = $request->nama_customer ? $request->nama_customer : $request->nama_customer;
             $reservasi_nana->no_hp = $request->no_hp ? $request->no_hp : $request->no_hp;
             $reservasi_nana->jumlah_orang = $request->jumlah_orang ? $request->jumlah_orang : $request->jumlah_orang;
             $reservasi_nana->nama_kamar = $request->nama_kamar ? $request->nama_kamar : $request->nama_kamar;
             $reservasi_nana->tanggal_reservasi = $request->tanggal_reservasi ? $request->tanggal_reservasi : $request->tanggal_reservasi;
             $reservasi_nana->tanggal_kepulangan = $request->tanggal_kepulangan ? $request->tanggal_kepulangan : $request->tanggal_kepulangan;
             $reservasi_nana->jumlah_hari = $request->jumlah_hari ? $request->jumlah_hari : $request->jumlah_hari;
             $reservasi_nana->harga_kamar = $request->harga_kamar ? $request->harga_kamar : $request->harga_kamar;
             $reservasi_nana->total = $request->total ? $request->total : $request->total;
             $reservasi_nana->save();
             return response()->json([
 
                 'status' => 200,
                 'data' => $reservasi_nana
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
         $reservasi_nana = Reservasi::where('id',$id )->first();
         if($reservasi_nana){
             $reservasi_nana->delete();
             return response()->json([
                 'status' => 200,
                 'data' => $reservasi_nana
             ],200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ],404);
         }
    }
}
