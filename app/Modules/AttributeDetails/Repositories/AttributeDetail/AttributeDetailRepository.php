<?php namespace Modules\AttributesDetails\Repositories\AttributeDetail;

use Modules\AttributeDetails\Models\AttributesDetail;
use App\Repositories\EloquentRepository;

class AttributeDetailRepository extends EloquentRepository implements AttributesDetailRepositoryInterface
{

    public function getModel()
    {
        return AttributeDetail::class;
    }



}
