<?php

namespace Modules\Payments\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Permission\Traits\HasRoles;

class Payment extends \App\Models\Payment
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];

    public function filterStatus(EloquentBuilder $query, $value)
    {
        $query->where('status', $value);
        return $query;
    }
}
