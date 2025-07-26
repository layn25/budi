<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('pages.kegiatan.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'rab_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->user_id = Auth::id();

        $kegiatan->nama_kegiatan = $validated['nama_kegiatan'];
        $kegiatan->tanggal_mulai = $validated['tanggal_mulai'];
        $kegiatan->tanggal_selesai = $validated['tanggal_selesai'];
        $kegiatan->deskripsi = $validated['deskripsi'] ?? null;

        if ($request->hasFile('proposal_file')) {
            $kegiatan->proposal_file = $request->file('proposal_file')->store('proposal', 'public');
        }
        if ($request->hasFile('rab_file')) {
            $kegiatan->rab_file = $request->file('rab_file')->store('rab', 'public');
        }
        if ($request->hasFile('lpj_file')) {
            $kegiatan->lpj_file = $request->file('lpj_file')->store('lpj', 'public');
        }

        $kegiatan->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'rab_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tanggal_mulai = $request->tanggal_mulai;
        $kegiatan->tanggal_selesai = $request->tanggal_selesai;
        $kegiatan->deskripsi = $request->deskripsi ?? null;
        $kegiatan->user_id = Auth::id();

        // Update file jika ada
        if ($request->hasFile('proposal_file')) {
            // Hapus file lama jika ada
            if ($kegiatan->proposal_file && Storage::exists($kegiatan->proposal_file)) {
                Storage::delete($kegiatan->proposal_file);
            }
            $kegiatan->proposal_file = $request->file('proposal_file')->store('proposal');
        }

        if ($request->hasFile('rab_file')) {
            if ($kegiatan->rab_file && Storage::exists($kegiatan->rab_file)) {
                Storage::delete($kegiatan->rab_file);
            }
            $kegiatan->rab_file = $request->file('rab_file')->store('rab');
        }

        if ($request->hasFile('lpj_file')) {
            if ($kegiatan->lpj_file && Storage::exists($kegiatan->lpj_file)) {
                Storage::delete($kegiatan->lpj_file);
            }
            $kegiatan->lpj_file = $request->file('lpj_file')->store('lpj');
        }

        $kegiatan->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui!');
    }
    public function delete($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }

}
