<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductAttribute extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'name',
        'image',
        'discount',
        'amount',
        'product_id',
        'warehouse_id',
    ];

    public function attributeDetail()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
