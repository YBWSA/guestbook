<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamuEksternal extends Model
{
    protected $table = 'tamu_eksternal';

    protected $fillable = [
        'nama',
        'no_hp',
        'instansi',
        'alamat',
        'hari_tgl',
        'sifat_kunjungan',
        'tujuan',
        'keperluan',
        'created_at',
    ];

    public $timestamps = false;
}
