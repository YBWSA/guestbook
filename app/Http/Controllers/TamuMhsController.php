<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TamuMhs;
use App\Http\Requests\TamuMhsRequest;

class TamuMhsController extends Controller
{
    public function store(TamuMhsRequest $request)
    {
        TamuMhs::create([
            'nama' => $request->namaMhs,
            'nim' => $request->nim,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'hari_tgl' => $request->tanggal_mhs,
            'tujuan' => $request->tujuan_mhs,
            'keperluan' => $request->keperluan_mhs,
            'created_at' => now(),
        ]);

        // var_dump($request->all());
        // die();

        return response()->json([
            'message' => 'Data berhasil disimpan!'
        ]);
    }
}
