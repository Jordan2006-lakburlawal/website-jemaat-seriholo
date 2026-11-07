<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use App\Models\JadwalIbadah;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = ProfileSetting::first();
        $jadwals = JadwalIbadah::orderBy('waktu', 'asc')->get();

        return view('admin.dashboard', compact('profile', 'jadwals'));
    }
}