<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::with(['user', 'kegiatan'])->get(); // atau pakai ->where('user_id', auth()->id()) jika perlu
        $kegiatan = Kegiatan::all(); // untuk dropdown form

        return view('pages.keuangan.index', compact('keuangan', 'kegiatan'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal' => 'required|date',
        ]);

        $keuangan = new Keuangan();
        $keuangan->user_id = Auth::id();
        $keuangan->kegiatan_id = $validated['kegiatan_id'];
        $keuangan->jenis_transaksi = $validated['jenis_transaksi'];
        $keuangan->jumlah = $validated['jumlah'];
        $keuangan->keterangan = $validated['keterangan'] ?? null;
        $keuangan->tanggal = $validated['tanggal'];

        if ($request->hasFile('bukti_file')) {
            $keuangan->bukti_file = $request->file('bukti_file')->store('bukti_keuangan' , 'public');
        }

        $keuangan->save();

        return redirect()->back()->with('success', 'Data keuangan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $keuangan = Keuangan::findOrFail($id);

        $validated = $request->validate([
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal' => 'required|date',
        ]);

        $keuangan->jenis_transaksi = $validated['jenis_transaksi'];
        $keuangan->jumlah = $validated['jumlah'];
        $keuangan->keterangan = $validated['keterangan'] ?? null;
        $keuangan->tanggal = $validated['tanggal'];

        if ($request->hasFile('bukti_file')) {
            if ($keuangan->bukti_file && Storage::exists($keuangan->bukti_file)) {
                Storage::delete($keuangan->bukti_file);
            }
            $keuangan->bukti_file = $request->file('bukti_file')->store('bukti_keuangan', 'public');
        }

        $keuangan->save();

        return redirect()->back()->with('success', 'Data keuangan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $keuangan = Keuangan::findOrFail($id);

        if ($keuangan->bukti_file && Storage::exists($keuangan->bukti_file)) {
            Storage::delete($keuangan->bukti_file);
        }

        $keuangan->delete();

        return redirect()->back()->with('success', 'Data keuangan berhasil dihapus.');
    }
}
