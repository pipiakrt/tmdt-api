<?php namespace Modules\Conditions\Repositories\Condition;

use Modules\Conditions\Models\Province;
use App\Repositories\EloquentRepository;

class ConditionRepository extends EloquentRepository implements ConditionRepositoryInterface
{

    public function getModel()
    {
        return Condition::class;
    }


}
