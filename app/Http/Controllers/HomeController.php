<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Peramalan;
use App\Models\HistorisStok;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::count();
        $barang = Barang::count();
        $totalStok = Barang::sum('jumlah');
        $stokMenipis = Barang::where('jumlah', '<=', 12)->get();
        $peramalanTerbaru = Peramalan::with('barang')->latest()->take(5)->get();
        $barangList = Barang::all();
        $tahunList = HistorisStok::selectRaw('LEFT(bulan, 4) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

        return view('pages.home.index', compact('user', 'barang', 'totalStok', 'stokMenipis', 'peramalanTerbaru', 'barangList', 'tahunList'));
    }

    public function chartData(Request $request)
    {
        $barangId = $request->barang_id;
        $tahun = $request->tahun;

        $query = HistorisStok::selectRaw('bulan, SUM(stok_terjual) as total')
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($barangId) {
            $query->where('id_barang', $barangId);
        }

        if ($tahun) {
            $query->whereRaw('LEFT(bulan, 4) = ?', [$tahun]);
        }

        $data = $query->get();

        $labels = $data->pluck('bulan');
        $values = $data->pluck('total');

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    // public function chartData(Request $request)
    // {
    //     $barangId = $request->barang_id;
    //     $tahun = $request->tahun ?? now()->year;

    //     $data = HistorisStok::selectRaw('bulan, SUM(stok_terjual) as total')
    //         ->when($barangId, function ($query) use ($barangId) {
    //             $query->where('id_barang', $barangId);
    //         })
    //         ->whereYear('bulan', $tahun)
    //         ->groupBy('bulan')
    //         ->orderBy('bulan')
    //         ->get();

    //     $labels = $data->pluck('bulan');
    //     $values = $data->pluck('total');

    //     return response()->json(['labels' => $labels, 'values' => $values]);
    // }


}
