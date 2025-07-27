<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use Uuid;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'kegiatan_id', 'id');
    }
    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'kegiatan_id', 'id');
    }

}
