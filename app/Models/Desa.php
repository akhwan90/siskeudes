<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //

    protected $primaryKey = 'kode_gabung'; // Set primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe data (string)

    protected $fillable = [
        'kode_prov',
        'kode_kab',
        'kode_kec',
        'kode_desa',
        'kode_gabung',
        'nama',
    ];
}
