<?php

namespace Modules\OrderHistories\Models;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class OrderHistory extends \App\Models\OrderHistory
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];

    public function filterOrder(EloquentBuilder $query, $value)
    {
        $query->where('order_id', $value);
        return $query;
    }


}
