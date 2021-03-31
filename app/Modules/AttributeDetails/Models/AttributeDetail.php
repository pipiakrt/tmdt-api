<?php

namespace Modules\AttributeDetails\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Permission\Traits\HasRoles;

class  AttributeDetail extends \App\Models\AttributeDetail
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
        'product_attribute_id'
    ];

    public function filterAsc(EloquentBuilder $query, $value)
    {
        $query->orderBy('id', 'ASC');
        return $query;
    }

    public function filterAttribute(EloquentBuilder $query, $value)
    {
        $query->where('product_attribute_id', $value);
        return $query;
    }

}
