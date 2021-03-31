<?php

namespace Modules\Districts\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class District extends \App\Models\District
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
        'province_id'
    ];
}
