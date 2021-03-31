<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'order_id',
        'order_status_id',
        'employee_id',
        'note',
    ];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function getCreatedAt()
    {
        return date('H:i A d/m/Y', strtotime($this['created_at']));
    }

}
