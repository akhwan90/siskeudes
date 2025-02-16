<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sumberdana extends Model
{
    //
    protected $primaryKey = 'kode'; // Set primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe data (string)

    protected $fillable = [
        'kode',
        'urutan',
        'nama',
    ];
}
