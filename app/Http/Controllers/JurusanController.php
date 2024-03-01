<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jrs = Jurusan::all();
        if (isset($jrs)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Jurusan',
                'data' => $jrs
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jurusan Tidak Ditemukan',
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
           // Di gunakan untuk menambah kan data Jurusan baru
        $data = [
            'nama_jurusan' => 'required',
            'singkatan_jurusan' => 'required',
            'jumlah_mahasantri' =>  'required|integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $jrs = new Jurusan;
            $jrs->nama_jurusan = $request->nama_jurusan;
            $jrs->singkatan_jurusan = $request->singkatan_jurusan;
            $jrs->jumlah_mahasantri = $request->jumlah_mahasantri;
            $jrs->save();
            $success = [
                'message' => 'Data Jurusan Berhasil ditambahkan',
                'data' => $jrs
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
        $jrs = Jurusan::where('id',$id)->first();
        if (isset($jrs)){
            $jrs->nama_jurusan = $request->input('nama_jurusan');
            $jrs->singkatan_jurusan = $request->input('singkatan_jurusan');
            $jrs->jumlah_jmahasantri = $request->input('jumlah_mahasantri');
            $jrs->save();
            $success = [
                "message" => "Data Jurusan Berhasil Diupdate",
                "data" => $jrs
            ];
            return response()->json($success, 200);
        }else {
            $fails = [
                "message" => "Data Jurusan Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
       }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // DIGUNAKAN UNTUK MENGHAPUS DATA Jurusan
         $jrs = Jurusan::where('id', $id)->first();
         if (isset($jrs)) {
             $jrs->delete();
             $success = [
                 "message" => "Data Jurusan Berhasil Dihapus",
                 "data" => $jrs
             ];
             return response()->json($success, 200);
         } else {
             $fails = [
                 "message" => "Data Jurusan Tidak Berhasil Dihapus",
             ];
             return response()->json($fails, 404);
         }
    }
}
