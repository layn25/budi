<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistorisStok;
use App\Models\Barang;

class HistorisStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil barang terakhir yang dimasukkan
        $barang = Barang::latest()->first();

        if (!$barang) {
            $this->command->warn('❌ Tidak ada data barang yang ditemukan. Silakan tambahkan data barang terlebih dahulu.');
            return;
        }

        // Cek apakah historis stok untuk barang ini sudah ada
        $existing = HistorisStok::where('id_barang', $barang->id)->count();

        if ($existing > 0) {
            $this->command->info("⚠️ Data historis stok untuk barang '{$barang->name}' sudah ada, tidak menambahkan ulang.");
            return;
        }

        // Buat 24 bulan historis stok ke belakang
        for ($i = 0; $i < 24; $i++) {
            HistorisStok::create([
                'id_barang' => $barang->id,
                'bulan' => now()->subMonths(24 - $i)->format('Y-m'),
                'stok_terjual' => rand(20, 100),
            ]);
        }

        $this->command->info("✅ Historis stok untuk barang '{$barang->name}' berhasil ditambahkan sebanyak 24 entri.");
    }
}
