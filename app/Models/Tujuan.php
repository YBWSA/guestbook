<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    protected $table = 'tujuan';

    protected $fillable = [
        'profesi',
        'nama',
        'jabatan',
        'unit'
    ];

    public $timestamps = false;
}
