<?php

namespace Modules\Favourite\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Favourite extends \App\Models\Favourite
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'user_id',
        'product_id'
    ];

    public function filterUser(EloquentBuilder $query, $value)
    {
        $query->where('user_id', $value);
        return $query;
    }

    
}
