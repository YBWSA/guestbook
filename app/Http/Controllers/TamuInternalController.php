<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\TamuInternal;
use App\Http\Requests\TamuInternalRequest;

class TamuInternalController extends Controller
{
    public function store(TamuInternalRequest $request)
    {
        TamuInternal::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'unit' => $request->unit,
            'unitHb' => $request->unit_homebase,
            'hari_tgl' => $request->tanggal_internal,
            'sifat_kunjungan' => $request->sifat_tujuan_kunjungan_internal,
            'tujuan' => $request->tujuan_internal,
            'keperluan' => $request->keperluan_internal,
            'created_at' => now(),
        ]);

        var_dump($request->all());
        die();

        return response()->json([
            'message' => 'Data berhasil disimpan!'
        ]);
    }
}
