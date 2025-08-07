<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamuMhs extends Model
{
    protected $table = 'tamu_mhs';

    protected $fillable = [
        'nim',
        'nama',
        'fakultas',
        'jurusan',
        'hari_tgl',
        'tujuan',
        'keperluan',
        'created_at',
    ];

    public $timestamps = false;
}
