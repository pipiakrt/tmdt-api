<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory, Cachable;

    public function getResizeAttribute($value) {
        return Storage::url($value);
    }

    public function getOriginAttribute($value) {
        return Storage::url($value);
    }
}
