<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class DetailPeramalan extends Model
{
    use Uuid;

    protected $table = 'detail_peramalans';
    protected $fillable = ['id_peramalan', 'hasil_ramalan', 'periode'];

    public function peramalan()
    {
        return $this->belongsTo(Peramalan::class, 'id_peramalan');
    }
    
}
