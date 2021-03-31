<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory, Cachable;

    public $table = 'product_user';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    

    
}
