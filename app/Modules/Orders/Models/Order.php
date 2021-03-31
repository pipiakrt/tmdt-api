<?php

namespace Modules\Orders\Models;

use App\Traits\Filterable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Order extends \App\Models\Order
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
        'district_id'
    ];
    
    public function filterStatus(EloquentBuilder $query, $value)
    {
        $query->where('status', $value);
        return $query;
    }
    public function filterUser(EloquentBuilder $query, $value)
    {
        $query->where('user_id', $value);
        return $query;
    }
    public function filterBooth(EloquentBuilder $query, $value)
    {
        $query->where('booth_id', $value);
        return $query;
    }
    public function filterNew(EloquentBuilder $query, $value)
    {
        $query->orderBy('id', 'DESC');
        return $query;
    }
    
    public function filterDate(EloquentBuilder $query, $value)
    {
        $query->whereBetween('created_at', $value);
        return $query;
    }

    public function filterKeyword(EloquentBuilder $query, $value)
    {
        $query->where('code', 'like', '%' . $value . '%')->orWhere('guest_name', 'like', '%' . $value . '%')->orWhere('guest_phone', 'like', '%' . $value . '%');
        return $query;
    }

    public function filterPrice(EloquentBuilder $query, $value)
    {
        $query->whereBetween('total', $value);
        return $query;
    }
    
    public function filterProvince(EloquentBuilder $query, $value)
    {
        $query->where('province_id', $value);
        return $query;
    }
    
    public function filterDistrict(EloquentBuilder $query, $value)
    {
        $query->where('district_id', $value);
        return $query;
    }
    
    public function filterWard(EloquentBuilder $query, $value)
    {
        $query->where('ward_id', $value);
        return $query;
    }
    
    /**
     * @var int
     */
}
