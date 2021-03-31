<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
    use HasFactory, Cachable;
    protected $connection = 'mongodb';

    protected $primaryKey = '_id';

    protected $fillable = [
        'to_id',
        'to_name',
        'from_id',
        'from_name',
        'title',
        'content',
        'type',
        'status',
        'seen',
    ];

}
