<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    
    public function update(Request $request)
    {
        $request->validate([
            'sejarah_jemaat' => 'required',
            'total_jemaat' => 'required|numeric',
            'total_sektor' => 'required|numeric',
            'total_unit' => 'required|numeric',
            'ketua_majelis' => 'nullable|string|max:255',
            'sekretaris_majelis' => 'nullable|string|max:255',
            'bendahara_jemaat' => 'nullable|string|max:255',
            'anggota_majelis' => 'nullable|string',
        ]);

        // Menggunakan updateOrCreate agar aman jika tabel masih kosong
        ProfileSetting::updateOrCreate(
            ['id' => 1], // Cari data dengan ID 1, jika tidak ada maka buat baru
            $request->except(['_token'])
        );

        return redirect()->back()->with('success', 'Data profil jemaat berhasil diperbarui!');
    }
}