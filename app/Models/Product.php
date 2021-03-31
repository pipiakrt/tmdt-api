<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\Provinces\Models\Province;
use Storage;

class Product extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'cover',
        'description',
        'origin_id',
        'province_id',
        'user_id',
        'booth_id',
        'price',
        'discount',
        'amount',
        'classification_group_one',
        'classification_group_two',
        'employee_id',
        'status',
        'condition_id',
        'weight',
        'length',
        'width',
        'height'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function booth()
    {
        return $this->belongsTo(Booth::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getProductAttribute()
    {
        $productAttributes  = ProductAttribute::where('product_id', $this->id)->get();
        $result = [];
        foreach ($productAttributes as $value)
        {    
            if ($value['image']) 
            {
                $value['image'] = Storage::url($value['image']);
            }
            $attributes = AttributeDetail::where('product_attribute_id', $value['id'])->orderBy('id', 'ASC')->get();

            $value['att'] = $attributes;
            $result[] = $value;
        }
        return $result;
    }
    public function getCreatedAt()
    {
        return date('H:i A d/m/Y', strtotime($this['created_at']));
    }

    public function favourite()
    {
        $check = Favourite::where([
            'user_id' => \Auth::id(),
            'product_id' => $this->id
        ])->first();

        if ($check) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
