<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileSetting;

class ProfileSettingSeeder extends Seeder
{
    public function run(): void
    {
        ProfileSetting::updateOrCreate(
            ['id' => 1],
            [
                'sejarah_jemaat' => 'Gereja Protestan Maluku (GPM) Jemaat Seriholo memiliki sejarah persekutuan dan pelayanan yang panjang...',
                'total_jemaat' => 1250,
                'total_sektor' => 6,
                'total_unit' => 18,
                'ketua_majelis' => 'Pdt. Nama Ketua',
                'sekretaris_majelis' => 'Nama Sekretaris',
                'bendahara_jemaat' => 'Nama Bendahara',
            ]
        );
    }
}