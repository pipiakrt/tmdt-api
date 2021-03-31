<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory, Cachable;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'avatar',
        'cover',
        'user_id',
        'employee_id',
        'status',
        'description'
    ];
    
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
    public function getCreatedAt()
    {
        return date('d/m/Y', strtotime($this['created_at']));
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
