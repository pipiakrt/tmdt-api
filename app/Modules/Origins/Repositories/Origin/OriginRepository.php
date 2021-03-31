<?php namespace Modules\Origins\Repositories\Origin;

use Modules\Origins\Models\Origin;
use App\Repositories\EloquentRepository;

class OriginRepository extends EloquentRepository implements OriginRepositoryInterface
{

    public function getModel()
    {
        return Origin::class;
    }



}
