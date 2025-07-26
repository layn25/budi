<?php

namespace App\Http\Controllers;

use App\Models\HistorisStok;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HistorisController extends Controller
{

    public function index()
    {
        $histori = HistorisStok::with('barang')->get(); // relasi
        return view('pages.histori.index', compact('histori'));
    }

    public function catatHistoris($barangId, $jumlahKeluar)
    {
    $bulan = Carbon::now()->format('Y-m');
    $historis = HistorisStok::firstOrNew([
        'id_barang' => $barangId,
        'bulan' => $bulan,
    ]);

    $historis->stok_terjual += $jumlahKeluar;
    $historis->save();

    }

    public function kurangiStok(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $jumlahKeluar = $request->input('jumlah'); // jumlah yang terjual

        if ($jumlahKeluar > $barang->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $barang->jumlah -= $jumlahKeluar;
        $barang->save();

        // Catat historisnya
        $this->catatHistoris($barang->id, $jumlahKeluar);

        return back()->with('success', 'Stok berhasil dikurangi & historis tercatat.');

    }

    //peramalan 
    // public function peramalanTES(Request $request)
    // {
    //     $alpha = $request->input('alpha', 0.5);
    //     $beta = $request->input('beta', 0.5);
    //     $gamma = $request->input('gamma', 0.5);
    //     $seasonLength = $request->input('season_length', 12); // misalnya bulanan

    //     $data = HistorisStok::orderBy('bulan')->pluck('stok_terjual')->toArray();

    //     $n = count($data);
    //     if ($n < $seasonLength * 2) {
    //         return back()->with('error', 'Data historis terlalu sedikit untuk peramalan.');
    //     }

    //     $level = $data[0];
    //     $trend = $data[1] - $data[0];
    //     $season = array_fill(0, $seasonLength, 0);

    //     for ($i = 0; $i < $seasonLength; $i++) {
    //         $season[$i] = $data[$i] - $level; // asumsi awal
    //     }

    //     $forecast = [];

    //     for ($i = 0; $i < $n; $i++) {
    //         $seasonalIndex = $i % $seasonLength;

    //         $prevLevel = $level;
    //         $level = $alpha * ($data[$i] - $season[$seasonalIndex]) + (1 - $alpha) * ($level + $trend);
    //         $trend = $beta * ($level - $prevLevel) + (1 - $beta) * $trend;
    //         $season[$seasonalIndex] = $gamma * ($data[$i] - $level) + (1 - $gamma) * $season[$seasonalIndex];

    //         $forecast[] = $level + $trend + $season[$seasonalIndex];
    //     }

    //     return view('pages.peramalan.index', [
    //         'actual' => $data,
    //         'forecast' => $forecast,
    //     ]);
    // }

}
