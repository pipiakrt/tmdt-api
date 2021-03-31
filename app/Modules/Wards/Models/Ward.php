<?php

namespace Modules\Wards\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Ward extends \App\Models\Ward
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
        'district_id'
    ];
}
