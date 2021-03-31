<?php

namespace Modules\Products\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Permission\Traits\HasRoles;

class Product extends \App\Models\Product
{
    use HasRoles, Filterable, Cachable;

    public $filterable = [
        'id',
    ];

    public function filterNew(EloquentBuilder $query, $value)
    {
        $query->orderBy('id', 'desc');
        return $query;
    }

    public function filterCategory(EloquentBuilder $query, $value)
    {
        $query->whereHas('categories', function($q) use ($value){
            $q->where('id', $value);
        });
        return $query;
    }
    public function filterTake(EloquentBuilder $query, $value)
    {
        $query->take($value);
        return $query;
    }

    public function filterSold(EloquentBuilder $query, $value)
    {
        $query->orderBy('sold', 'DESC');
        return $query;
    }

    public function filterName(EloquentBuilder $query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
        return $query;
    }

    public function filterBooth(EloquentBuilder $query, $value)
    {
        $query->where('booth_id', $value);
        return $query;
    }

    public function filterArrStatus(EloquentBuilder $query, $value)
    {
        $query->whereIn('status', $value);
        return $query;
    }

    public function filterDateStart(EloquentBuilder $query, $value)
    {
        $query->whereDate('created_at', '>=',  $value);
        return $query;
    }
    public function filterDateEnd(EloquentBuilder $query, $value)
    {
        $query->whereDate('created_at', '<=',  $value);
        return $query;
    }
    public function filterStatus(EloquentBuilder $query, $value)
    {
        $query->where('status', $value);
        return $query;
    }
    public function filterPriceOne(EloquentBuilder $query, $value)
    {
        $query->where('discount', '>=', $value);
        return $query;
    }
    public function filterPriceTwo(EloquentBuilder $query, $value)
    {
        $query->where('discount', '<=', $value);
        return $query;
    }
    public function filterStar(EloquentBuilder $query, $value)
    {
        $query->where('star', '<=', $value);
        return $query;
    }
    public function filterProvince(EloquentBuilder $query, $value)
    {
        $query->whereIn('province_id', $value);
        return $query;
    }
    public function filterCondition(EloquentBuilder $query, $value)
    {
        $query->whereIn('condition_id', $value);
        return $query;
    }

    public function filterShort(EloquentBuilder $query, $value)
    {
        $query->orderBy('discount', 'ASC');
        return $query;
    }
    public function filterHigh(EloquentBuilder $query, $value)
    {
        $query->orderBy('discount', 'DESC');
        return $query;
    }

    public function Count()
    {
        return Product::where([
            'status' => 2,
            'booth_id' => \Auth::id(),
        ])->count();
    }
    public function filterHighlight(EloquentBuilder $query, $value)
    {
        $query->with('booth', function ($q) {
            $q->where('highlight', true);
        });
        return $query;
    }


//    public function newQuery($excludeDeleted = true) {
//        $query = parent::newQuery($excludeDeleted);
//        $query->where('status', true);
//
//        return $query;
//    }

}
