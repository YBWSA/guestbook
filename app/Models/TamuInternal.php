<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamuInternal extends Model
{
    protected $table = 'tamu_internal';

    protected $fillable = [
        'nama',
        'nip',
        'unit',
        'unitHb',
        'hari_tgl',
        'sifat_kunjungan',
        'tujuan',
        'keperluan',
        'created_at',
    ];

    public $timestamps = false;

    public function tujuanRelasi()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan');
    }
}
