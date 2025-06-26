<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UnissulaApiService;
use Illuminate\Http\JsonResponse;

class MahasiswaController extends Controller
{
    protected UnissulaApiService $api;

    public function __construct(UnissulaApiService $api)
    {
        $this->api = $api;
    }

    public function daftarMhs(Request $request): JsonResponse
    {
        try {
            $nim = $request->query('nim');

            $result = $this->api->sendRequest('akademik/mahasiswa/all', ['nim' => $nim]);

            // Filter NIM persis
            if (isset($result['hasil']) && is_array($result['hasil'])) {
                $filtered = collect($result['hasil'])->filter(function ($item) use ($nim) {
                    return $item['nim'] === $nim;
                })->values()->all(); // reset index

                $result['hasil'] = $filtered;
            }

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
