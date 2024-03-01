<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasantri;
use Illuminate\Support\Facades\Validator;

class MahasantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mhs = Mahasantri::all();
        if (isset($mhs)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Mahasantri',
                'data' => $mhs
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Mahasantri Tidak Ditemukan',
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
        // Di gunakan untuk menambah kan data mahasantri baru
        $data = [
            'nama_mhs' => 'required',
            'alamat_mhs' => 'required',
            'umur_mhs' =>  'required | integer',
            'id_mhs' => 'required | integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $mhs = new Mahasantri;
            $mhs->nama_mhs = $request->nama_mhs;
            $mhs->alamat_mhs = $request->alamat_mhs;
            $mhs->umur_mhs = $request->umur_mhs;
            $mhs->id_mhs = $request->id_mhs;
            $mhs->save();
            $success = [
                'message' => 'Data Mahasantri Berhasil ditambahkan',
                'data' => $mhs
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
         //DIGUNAKAN UNTUK MEMPERBARUI DATA MAHASANTRI
         $mhs = Mahasantri::where('id',$id)->first();
         if (isset($mhs)){
             $mhs->nama_mhs = $request->input('nama_mhs');
             $mhs->alamat_mhs = $request->input('alamat_mhs');
             $mhs->umur_mhs = $request->input('umur_mhs');
             $mhs->id_jrs = $request->input('id_jrs');
             $mhs->save();
             $success = [
                 "message" => "Data Mahasantri Berhasil Diupdate",
                 "data" => $mhs
             ];
             return response()->json($success, 200);
         }else {
             $fails = [
                 "message" => "Data Mahasantri Tidak Ditemukan",
             ];
             return response()->json($fails, 404);
        }
 
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DIGUNAKAN UNTUK MENGHAPUS DATA MAHASANTRI
        $mhs = Mahasantri::where('id', $id)->first();
        if (isset($mhs)) {
            $mhs->delete();
            $success = [
                "message" => "Data Mahasantri Berhasil Dihapus",
                "data" => $mhs
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Mahasantri Tidak Berhasil Dihapus",
            ];
            return response()->json($fails, 404);
        }
    }
}
