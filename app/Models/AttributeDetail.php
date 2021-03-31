<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class AttributeDetail extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'amount',
        'product_attribute_id',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product_attributes()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
