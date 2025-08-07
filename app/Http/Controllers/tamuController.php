<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;
use App\Models\TamuMhs;
use App\Models\TamuInternal;
use App\Models\TamuEksternal;
use Illuminate\Support\Carbon;



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

        // Hari ini
        $today = Carbon::today();
        // dump($today);

        // Hitung jumlah tamu hari ini dari masing-masing model
        $countMhs = TamuMhs::whereDate('created_at', $today)->count();
        $countInternal = TamuInternal::whereDate('created_at', $today)->count();
        $countEksternal = TamuEksternal::whereDate('created_at', $today)->count();

        $totalTamuHariIni = $countMhs + $countInternal + $countEksternal;
        // dump($totalTamuHariIni);

        return view('tamu.view', compact('tujuan', 'totalTamuHariIni'));
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


    function index_latihan()
    {
        return '<h1>Ini halaman buku tamu admin setelah login</h1>';
    }
}
