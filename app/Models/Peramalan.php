<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peramalan extends Model
{
    protected $table = 'peramalans';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id', 'id_barang', 'mape', 'tanggal_peramalan'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function detail()
    {
        return $this->hasMany(DetailPeramalan::class, 'id_peramalan');
    }
}

