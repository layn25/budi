<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Barang extends Model
{
    //
    use Uuid;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function historisStok()
    {
        return $this->hasMany(\App\Models\HistorisStok::class, 'id_barang');
    }
    public function peramalan()
    {
        return $this->hasMany(\App\Models\Peramalan::class);
    }

}
