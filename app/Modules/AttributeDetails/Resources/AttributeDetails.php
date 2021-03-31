<?php

namespace Modules\AttributeDetails\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class AttributeDetails extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'amount'    => $this->amount,
            'discount'  => $this->discount,
            'product_attribute_id' => $this->product_attribute_id,
//            'name'      => $this->name,
//            'percent'   => 10,
//            'discount'  => $this->discount,
//            'avatar'    => url('/').$this->avatar,
//            'categories'  => $this->categories,
//            'slug'      => $this->slug,
        ];
    }
}
