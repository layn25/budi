<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Barang;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Mengirimkan data stok menipis ke semua view
        View::composer('*', function ($view) {
            $stokMenipis = Barang::where('jumlah', '<=', 12)->get();
            $view->with('stokMenipis', $stokMenipis);
        });
    }
}
