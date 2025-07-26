<?php

namespace App\Models;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;

class HistorisStok extends Model
{
    use Uuid;

    protected $fillable = ['id_barang', 'bulan', 'stok_terjual'];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

}
