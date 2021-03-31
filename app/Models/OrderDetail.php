<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\Products\Models\Product;

class OrderDetail extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
        'product_attribute_id',
        'attribute_detail_id',
        'name_product_attribute',
        'name_attribute_detail'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function productAtrribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
    public function atrributeDetail()
    {
        return $this->belongsTo(AttributeDetail::class, 'attribute_detail_id');
    }
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
    public function attributeDetail()
    {
        return $this->belongsTo(AttributeDetail::class, 'attribute_detail_id');
    }


}
