<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TamuEksternal;
use App\Http\Requests\TamuEksternalRequest;


class TamuEksternalController extends Controller
{
    public function store(TamuEksternalRequest $request)
    {
        TamuEksternal::create([
            'nama' => $request->nama_eksternal,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'hari_tgl' => $request->tanggal_eksternal,
            'sifat_kunjungan' => $request->sifat_tujuan_kunjungan_eksternal,
            'tujuan' => $request->tujuan_eksternal,
            'keperluan' => $request->keperluan_eksternal,
            'created_at' => now(),
        ]);


        // var_dump($request->all());
        // die();

        return response()->json([
            'message' => 'Data berhasil disimpan!'
        ]);
    }
}
