<?php

namespace Modules\Provinces\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Province extends \App\Models\Province
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];
}
