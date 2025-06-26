<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\YbwsaApiService;
use Illuminate\Http\JsonResponse;

class PegawaiController extends Controller
{
    protected YbwsaApiService $api;

    public function __construct(YbwsaApiService $api)
    {
        $this->api = $api;
    }

    public function daftarPegawai(Request $request): JsonResponse
    {
        try {
            $nama = $request->query('nama');

            $result = $this->api->sendRequest('dev/sdi/daftar', ['nama' => $nama]);

            $dataPeg = collect($result['hasil'] ?? [])->map(function ($item) {
                return [
                    'label'   => "{$item['nip']} - {$item['nama']}",
                    'value'   => $item['nama'],
                    'nama'    => $item['nama'],
                    'nip'     => $item['nip'],
                    'unit'    => $item['unit']['unit'] ?? '',
                    'unitHB'  => $item['unit']['homebase'] ?? '',
                ];
            });

            return response()->json($dataPeg);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
