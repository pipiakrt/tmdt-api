<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory, Cachable;
    protected $fillable = [
        'id',
        'name',
        'level',
        'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
