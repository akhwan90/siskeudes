<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    //
    protected $primaryKey = 'kode_gabung'; // Set primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe data (string)

    protected $fillable = [
        'kode_bidang',
        'kode_gabung',
        'nama',
    ];
}
