<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('pages.anggota.index', compact('anggota'));
    }
    // Simpan anggota baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $anggota = new Anggota();
        $anggota->nama = $validated['nama'];
        $anggota->kontak = $validated['kontak'];
        $anggota->alamat = $validated['alamat'];
        $anggota->status = $validated['status'];

        if ($request->hasFile('foto')) {
            $anggota->foto = $request->file('foto')->store('foto_anggota','public');
        }

        $anggota->save();

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $anggota->nama = $validated['nama'];
        $anggota->kontak = $validated['kontak'];
        $anggota->alamat = $validated['alamat'];
        $anggota->status = $validated['status'];

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($anggota->foto && Storage::exists($anggota->foto)) {
                Storage::delete($anggota->foto);
            }
            $anggota->foto = $request->file('foto')->store('foto_anggota','public');
        }

        $anggota->save();

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
    }

    // Hapus anggota
    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Hapus file foto jika ada
        if ($anggota->foto && Storage::exists($anggota->foto)) {
            Storage::delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus.');
    }
}
