<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemda extends Model
{
//
    protected $primaryKey = 'kode_gabung'; // Set primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe data (string)

    protected $fillable = [
        'nama',
        'alamat',
        'ibukota',
        'nama_bupati',
        'jabatan_bupati',
    ];
}
