<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistorisStok;
use App\Models\Peramalan;
use App\Models\DetailPeramalan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PeramalanController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $hasilPeramalan = Peramalan::with(['barang', 'detail'])->latest()->get(); // relasi barang & detail
        return view('pages.peramalan.index', compact('hasilPeramalan', 'barang'));
    }

    // public function form()
    // {
    //     $barangs = Barang::all();
    //     $hasilPeramalan = Peramalan::with('barang')->orderByDesc('created_at')->get();
    //     return view('pages.peramalan.index', compact('barangs', 'hasilPeramalan'));
    // }

    public function hitung(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'periode' => 'required|integer|min:1',
        ]);

        $barangId = $request->barang_id;
        $nPeriode = $request->periode;

        $historis = HistorisStok::where('id_barang', $barangId)
            ->orderBy('bulan')
            ->get();

        $data = $historis->pluck('stok_terjual')->toArray();
        $nMusim = 12;

        if (count($data) < ($nMusim * 2)) {
            return back()->with('error', 'Data historis terlalu sedikit untuk melakukan peramalan.');
        }

        // Inisialisasi smoothing constant
        $alpha = 0.4;
        $beta = 0.4;
        $gamma = 0.4;

        $level = $data[0];
        $trend = $data[1] - $data[0];
        $season = array_fill(0, $nMusim, 1.0);

        for ($i = 0; $i < $nMusim; $i++) {
            $season[$i] = $data[$i] / max($level, 1);
        }

        $forecast = [];
        $MAPE = 0;
        $nMAPE = 0;

        for ($i = 0; $i < count($data); $i++) {
            $seasonIndex = $i % $nMusim;

            if ($i >= $nMusim) {
                $lastLevel = $level;
                $lastTrend = $trend;

                $level = $alpha * ($data[$i] / $season[$seasonIndex]) + (1 - $alpha) * ($lastLevel + $lastTrend);
                $trend = $beta * ($level - $lastLevel) + (1 - $beta) * $lastTrend;
                $season[$seasonIndex] = $gamma * ($data[$i] / max($level, 1)) + (1 - $gamma) * $season[$seasonIndex];

                $forecastValue = ($level + $trend) * $season[$seasonIndex];
                $forecast[] = round($forecastValue);

                if ($data[$i] != 0) {
                    $MAPE += abs(($data[$i] - $forecastValue) / $data[$i]);
                    $nMAPE++;
                }
            } else {
                $forecast[] = null;
            }
        }

        $MAPE = $nMAPE > 0 ? round(($MAPE / $nMAPE) * 100, 2) : 0;

        // Peramalan ke depan
        $ramalanBaru = [];
        $dataCount = count($data);
        for ($i = 1; $i <= $nPeriode; $i++) {
            $future = ($level + $i * $trend) * $season[($dataCount + $i) % $nMusim];
            $bulanRamalan = Carbon::now()->addMonths($i)->format('Y-m');
            $ramalanBaru[] = [
                'periode' => $bulanRamalan,
                'hasil' => round($future),
            ];
        }

        // Simpan ke tabel `peramalan`
        $peramalan = Peramalan::create([
            'id_barang' => $barangId,
            'mape' => $MAPE,
            'tanggal_peramalan' => Carbon::now()->format('Y-m-d')
        ]);

        // Simpan ke tabel `detail_peramalan`
        foreach ($ramalanBaru as $r) {
            DetailPeramalan::create([
                'id_peramalan' => $peramalan->id,
                'periode' => $r['periode'],
                'hasil_ramalan' => $r['hasil']
            ]);
    }
        return redirect()->route('peramalan.index')->with('success', 'Peramalan berhasil dihitung dan disimpan.');
}

public function lihatHasil($id)
{
    $peramalan = Peramalan::with(['barang','detail' => function ($query) {
            $query->orderBy('periode', 'asc');
        }
    ])->findOrFail($id);

    // Ambil data barang, detail ramalan, dan nilai MAPE
    $barang = $peramalan->barang;
    $ramalanBaru = $peramalan->detail->map(function ($detail) {
        return [
            'periode' => $detail->periode,
            'hasil' => $detail->hasil_ramalan
        ];
    });

    $MAPE = $peramalan->mape;

    return view('pages.peramalan.components.hasil', compact('barang', 'ramalanBaru', 'MAPE'));
}

}