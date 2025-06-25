<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tamuController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }


    function index_latihan()
    {
        return '<h1>Ini halaman buku tamu admin setelah login</h1>';
    }
}
