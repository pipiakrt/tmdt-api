<?php

namespace Modules\Origins\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Origin extends \App\Models\Origin
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];
}
