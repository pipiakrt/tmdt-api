<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory, Cachable;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
