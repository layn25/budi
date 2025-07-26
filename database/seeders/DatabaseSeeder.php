<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HistorisStok;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // for ($i = 0; $i < 24; $i++) {
        //     HistorisStok::create([
                
        //         'id_barang' => ' 	3fa0d340-f29f-49a2-9227-b96b2c02d085',
        //         'bulan' => now()->subMonths(24 - $i)->format('Y-m'),
        //         'stok_terjual' => rand(20, 100),
                
        //     ]);
        // }

    }
}