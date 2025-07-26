<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use Uuid;

    protected $guarded = [];
}
