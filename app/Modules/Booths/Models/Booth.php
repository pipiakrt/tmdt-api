<?php

namespace Modules\Booths\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Booth extends \App\Models\Booth
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];
}
