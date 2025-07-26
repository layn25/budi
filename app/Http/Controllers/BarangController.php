<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('pages.barang.index', compact('barang'));
    }
    public function create(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:Kancing,Kain,Benang,Resleting,Jarum,Gunting,Minyak Mesin,Penggaris,Karet,Tali,Label,Aksesoris,Lainnya',
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:0',
        ]);

        $barang = new Barang();
        $barang->user_id = Auth::id();  
        $barang->name = $validated['name'];
        $barang->deskripsi = $validated['deskripsi'];
        $barang->kategori = $validated['kategori'];
        $barang->harga = $validated['harga'];
        $barang->jumlah = $validated['jumlah'];
        $barang->save();

        // Mengembalikan response
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:Kancing,Kain,Benang,Resleting,Jarum,Gunting,Minyak Mesin,Penggaris,Karet,Tali,Label,Aksesoris,Lainnya',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id);
        $jumlahLama = $barang->jumlah; // ambil stok sebelum diubah

        $barang->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'user_id' => Auth::id(),
        ]);

        // Cek jika stok berkurang
        if ($request->jumlah < $jumlahLama) {
            $jumlahKeluar = $jumlahLama - $request->jumlah;

            // Catat ke histori stok
            app(\App\Http\Controllers\HistorisController::class)
                ->catatHistoris($barang->id, $jumlahKeluar);
        }

        return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }

    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);
        $jumlahLama = $barang->jumlah;
        $jumlahBaru = $jumlahLama + $request->jumlah;

        $barang->update([
            'jumlah' => $jumlahBaru,
            'user_id' => Auth::id(), // untuk tracking siapa yang update
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditambahkan.');
    }


    //ngetest
    public function show($id)
    {
        $barang = Barang::with('historisStok')->findOrFail($id);
        // Urutkan histori berdasarkan bulan
        $historis = $barang->historisStok->sortBy('bulan');

        return view('barang.show', compact('barang', 'historis'));

    }

    public function stokMenipis()
    {
        $barangs = Barang::where('jumlah', '<=', 12)->get();
        return view('pages.barang.components.stok-menipis', compact('barangs'));
    }


}
