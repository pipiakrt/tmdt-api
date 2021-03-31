<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory, Cachable;
    protected $fillable = [
        'id',
        'name',
        'level',
        'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
