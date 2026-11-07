<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Tampilkan halaman form login
    public function showLoginForm()
    {
        // Jika sudah login, langsung lempar ke dashboard admin
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Proses data login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Tentukan username & password admin di sini (bisa Anda sesuaikan)
        $usernameAdmin = 'admin';
        $passwordAdmin = 'seriholo123';

        if ($request->username === $usernameAdmin && $request->password === $passwordAdmin) {
            // Set session bahwa admin sudah login
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk ke Admin Panel!');
        }

        return back()->withErrors(['login' => 'Username atau Password salah!']);
    }

    // Proses keluar / reset session saat kembali ke halaman utama
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('welcome');
    }
}