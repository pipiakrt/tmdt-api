<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\AttributeDetails\Models\AttributeDetail;

class Order extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'guest_name',
        'guest_phone',
        'guest_email',
        'guest_address',
        'province_id',
        'district_id',
        'ward_id',
        'transport_id',
        'status_pay',
        'payment_id',
        'user_id',
        'employee_id',
        'code',
        'booth_id',
        'status',
        'note',
        'ship_price',
        'shipper_id',
        'total',
        'status_id_delivery',
        'id_delivery',
        'estimated_pick_time',
        'estimated_deliver_time',
        'tracking_id_delivery',
        'package_name_freight',
        'shipped_at',
        'completed_at',
    ];

    
  
    public function booth()
    {
        return $this->belongsTo(Booth::class);
    }
  
    public function OrderDetail() {
        return $this->hasMany(OrderDetail::class,'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Products\Models\Product::class, 'order_details', 'order_id', 'product_id')
            ->withPivot('product_attribute_id', 'attribute_detail_id', 'name_product_attribute','name_attribute_detail','quantity','price');
    }
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
    public function attributeDetail()
    {
        return $this->belongsTo(AttributeDetail::class);
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class,'id','status');
    }

    public function orderUsers()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
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

    public function transport()
    {
        return $this->belongsTo(Transport::class,'transport_id');
    }

    public function getOrderDetail()
    {
        $orderDetails = OrderDetail::where('order_id', $this->id)->get();
        $result = [];
        foreach ($orderDetails as $detail){
            if($detail['attribute_detail_id']){
                $detail['attribute_detail'] = AttributeDetail::findOrFail($detail['attribute_detail_id']);
            }else
                $detail['attribute_detail'] = [];

            if($detail['product_attribute_id']){
                $detail['product_attribute'] = ProductAttribute::findOrFail($detail['product_attribute_id']);
            }else
                $detail['product_attribute'] = [];

            if($detail['product_id']){
                $detail['product'] = Product::findOrFail($detail['product_id']);
            }else
                $detail['product'] = [];

            $result[] = $detail;
        }
        return $result;
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }
}
