<?php

namespace Modules\AddressUsers\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Permission\Traits\HasRoles;

class AddressUser extends \App\Models\AddressUser
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];

    public function filterUserId(EloquentBuilder $query, $value)
    {
        $query->where('user_id', $value);
        return $query;
    }
    public function filterStatus(EloquentBuilder $query, $value)
    {
        $query->where('status', $value);
        return $query;
    }
}
