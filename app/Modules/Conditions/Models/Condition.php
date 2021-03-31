<?php

namespace Modules\Conditions\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Condition extends \App\Models\Condition
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];
    public function newQuery($excludeDeleted = true) {
        $query = parent::newQuery($excludeDeleted);
        $query->where('status', true);

        return $query;
    }
}
