<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;

class tamuController extends Controller
{

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



    public function view()
    {
        $tujuan = Tujuan::all()->groupBy('profesi');
        return view('tamu.view', compact('tujuan'));
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
