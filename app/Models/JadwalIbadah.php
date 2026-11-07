<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ibadah',
        'waktu',
        'tempat',
        'pelayan_firman',
        'bacaan_firman',
        'file_liturgi',
    ];
}