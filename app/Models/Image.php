<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory, Cachable;
    protected $fillable = [
        'url',
        'product_id'
    ];

    public function getUrlAttribute($value) {
        return Storage::url($value);
    }

}
