<?php

namespace App\Http\Controllers;

use App\Models\ProfileSetting;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil utama jemaat.
     */
    public function index()
    {
        $setting = ProfileSetting::first();
        return view('profile', compact('setting'));
    }

    /**
     * Menampilkan halaman daftar jadwal ibadah untuk jemaat.
     */
    public function jadwal()
    {
        $jadwals = JadwalIbadah::orderBy('waktu', 'asc')->get();
        return view('jadwal', compact('jadwals'));
    }
}