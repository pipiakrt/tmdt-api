<?php namespace Modules\Booths\Repositories\Booth;

use Modules\Booths\Models\Booth;
use App\Repositories\EloquentRepository;

class BoothRepository extends EloquentRepository implements BoothRepositoryInterface
{

    public function getModel()
    {
        return Booth::class;
    }


}
