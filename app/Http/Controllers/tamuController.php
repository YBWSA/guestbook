<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;
use App\Models\TamuMhs;
use App\Models\TamuInternal;
use App\Models\TamuEksternal;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;



class tamuController extends Controller
{


    /**
     * tujuan bertemu
     * */
    public function getTujuan(Request $request)
    {
        $profesi = $request->get('profesi');

        $tujuan = Tujuan::where('profesi', $profesi)->get(['id', 'unit', 'jabatan', 'nama']);

        // Kelompokkan berdasarkan unit
        $grouped = $tujuan->groupBy('unit');

        $response = [];

        foreach ($grouped as $unit => $items) {
            $options = [];
            foreach ($items as $item) {
                $options[] = [
                    'id' => $item->id,
                    'text' => $item->nama . ' - ' . $item->jabatan,
                ];
            }

            $response[] = [
                'unit' => $unit,
                'data' => $options,
            ];
        }

        return response()->json($response);
    }



    /**
     * view halaman depan buku tamu
     * */
    public function view()
    {
        $tujuan = Tujuan::all()->groupBy('profesi');
        // dump($tujuan);

        return view('tamu.view', compact('tujuan'));
    }

    /**total jumlah tamu hari ini */

    public function getTotalTamuHariIni(): JsonResponse
    {
        $today = Carbon::today();

        $countMhs = TamuMhs::whereDate('created_at', $today)->count();
        $countInternal = TamuInternal::whereDate('created_at', $today)->count();
        $countEksternal = TamuEksternal::whereDate('created_at', $today)->count();

        $total = $countMhs + $countInternal + $countEksternal;

        return response()->json([
            'total' => $total,
        ]);
    }



    /**
     * Display the admin index view.
     *
     * @return \Illuminate\View\View
     */
    // This method is used to show the admin dashboard after login
    public function index()
    {


        return view('admin.index');
    }

    // tamu internal
    public function tamuInternal()
    {
        $data = TamuInternal::latest()->paginate(10);
        // dd($data);

        return view('admin.internal', ['data' => $data]);
    }

    public function tamuEksternal()
    {
        return view('admin.eksternal');
    }

    public function tamuMhs()
    {
        return view('admin.mahasiswa');
    }


    // function index_latihan()
    // {
    //     return '<h1>Ini halaman buku tamu admin setelah login</h1>';
    // }
}
