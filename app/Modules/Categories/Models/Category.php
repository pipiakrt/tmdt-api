<?php

namespace Modules\Categories\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Category extends \App\Models\Category
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
        'type',
        'status' => 1,
    ];

    public function filterParent(EloquentBuilder $query, $value)
    {
        $query->whereNull('parent_id');
        return $query;
    }

    public function filterParentId(EloquentBuilder $query, $value)
    {
        $query->where('parent_id', $value);
        return $query;
    }
    public function newQuery($excludeDeleted = true) {
        $query = parent::newQuery($excludeDeleted);
        $query->where('status', true);

        return $query;
    }
}
