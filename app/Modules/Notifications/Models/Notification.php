<?php

namespace Modules\Notifications\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Auth;

class Notification extends \App\Models\Notification
{
    use HasRoles, Filterable, Cachable; 
    
    public $filterable = [
        'id',
    ];

    public function filterStatus(EloquentBuilder $query, $value)
    {
        $query->where(['status' => $value, 'to_id' => Auth::id()]);
        return $query;
    }
}

