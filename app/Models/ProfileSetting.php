<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'sejarah_jemaat',
        'total_jemaat',
        'total_sektor',
        'total_unit',
        'ketua_majelis',
        'sekretaris_majelis',
        'bendahara_jemaat',
        'anggota_majelis',
    ];
}