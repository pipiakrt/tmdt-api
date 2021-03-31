<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'status',
        'user_id'
    ];


    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }


    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class,'ward_id');
    }
}
