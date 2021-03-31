<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory, Cachable;
    protected $fillable = [
        'id',
        'name',
        'level',
    ];
}
