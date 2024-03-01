<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pr = Produk::all();
        if (isset($pr)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Produk',
                'data' => $pr
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => 'required',
            'stok' => 'required | integer',
            'harga' =>  'required | integer',
            'idjenis' => 'required | integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $pr = new Produk;
            $pr->nama = $request->nama;
            $pr->stok = $request->stok;
            $pr->harga = $request->harga;
            $pr->idjenis = $request->idjenis;
            $pr->save();
            $success = [
                'message' => 'Data Produk Berhasil ditambahkan',
                'data' => $pr
            ];
            return response()->json($success, 200);
        }
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
        $pr = Produk::where('id',$id)->first();
        if (isset($pr)){
            $pr->nama = $request->input('nama');
            $pr->stok = $request->input('stok');
            $pr->harga = $request->input('harga');
            $pr->idjenis = $request->input('idjenis');
            $pr->save();
            $success = [
                "message" => "Data Produk Berhasil Diupdate",
                "data" => $pr
            ];
            return response()->json($success, 200);
        }else {
            $fails = [
                "message" => "Data Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pr = Produk::where('id', $id)->first();
        if (isset($pr)) {
            $pr->delete();
            $success = [
                "message" => "Data Produk Berhasil Dihapus",
                "data" => $pr
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Berhasil Dihapus",
            ];
            return response()->json($fails, 404);
        }
    }
}
