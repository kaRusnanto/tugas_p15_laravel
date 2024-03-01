<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProduk;
use Illuminate\Support\Facades\Validator;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jpr = JenisProduk::all();
        if (isset($jpr)) {
            $hasil = [
                'success' => true,
                'message' => 'Data JenisProduk',
                'data' => $jpr
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data JenisProduk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'nama' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $jpr = new JenisProduk;
            $jpr->nama = $request->nama;
            $jpr->save();
            $success = [
                'message' => 'Data Jenis Produk Berhasil ditambahkan',
                'data' => $jpr
            ];
            return response()->json($success, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $jpr = JenisProduk::where('id',$id)->first();
        if (isset($pr)){
            $jpr->nama = $request->input('nama');
            $jpr->save();
            $success = [
                "message" => "Data Jenis Produk Berhasil Diupdate",
                "data" => $jpr
            ];
            return response()->json($success, 200);
        }else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jpr = JenisProduk::where('id', $id)->first();
        if (isset($jpr)) {
            $jpr->delete();
            $success = [
                "message" => "Data Jenis Produk Berhasil Dihapus",
                "data" => $jpr
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Berhasil Dihapus",
            ];
            return response()->json($fails, 404);
        }
    }
}
