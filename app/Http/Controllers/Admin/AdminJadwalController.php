<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalIbadah::orderBy('waktu', 'asc')->get();
        return view('admin.dashboard', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ibadah'    => 'required|string|max:255',
            'waktu'          => 'required|date',
            'tempat'         => 'required|string|max:255',
            'pelayan_firman' => 'required|string|max:255',
            'bacaan_firman'  => 'required|string|max:255',
            'file_liturgi'   => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->except('file_liturgi');

        if ($request->hasFile('file_liturgi')) {
            $file = $request->file('file_liturgi');
            
            // Membersihkan nama file dari spasi dan karakter khusus (seperti +, (), dll)
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = preg_replace('/[^A-Za-z0-9-_]/', '_', $originalName);
            $filename = time() . '_' . $cleanName . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/liturgi'), $filename);
            
            // Simpan path file ke database
            $data['file_liturgi'] = 'uploads/liturgi/' . $filename;
        }

        JadwalIbadah::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal ibadah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        return view('admin.jadwal-edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);

        $request->validate([
            'nama_ibadah'    => 'required|string|max:255',
            'waktu'          => 'required|date',
            'tempat'         => 'required|string|max:255',
            'pelayan_firman' => 'required|string|max:255',
            'bacaan_firman'  => 'required|string|max:255',
            'file_liturgi'   => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->except('file_liturgi');

        if ($request->hasFile('file_liturgi')) {
            // Hapus file lama jika ada
            if ($jadwal->file_liturgi && file_exists(public_path($jadwal->file_liturgi))) {
                unlink(public_path($jadwal->file_liturgi));
            }

            $file = $request->file('file_liturgi');
            
            // Membersihkan nama file baru dari spasi dan karakter khusus
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = preg_replace('/[^A-Za-z0-9-_]/', '_', $originalName);
            $filename = time() . '_' . $cleanName . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/liturgi'), $filename);
            
            // Simpan path file ke database
            $data['file_liturgi'] = 'uploads/liturgi/' . $filename;
        }

        $jadwal->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal ibadah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        
        if ($jadwal->file_liturgi && file_exists(public_path($jadwal->file_liturgi))) {
            unlink(public_path($jadwal->file_liturgi));
        }
        
        $jadwal->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal ibadah berhasil dihapus!');
    }
}