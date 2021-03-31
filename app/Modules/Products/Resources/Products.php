<?php

namespace Modules\Products\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Products extends JsonResource
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
            'price'     => $this->price,
            'discount'  => $this->discount,
            'amount'    => $this->amount,
            'avatar'    => \Storage::url($this->avatar),
            'categories'=> $this->categories,
            'slug'      => $this->slug,
            'sold'      => $this->sold,
            'star'      => $this->star,
            'booth_id'      => $this->booth_id,
            'favourite' => $this->favourite,
            'checkfavourite' => $this->favourite(),
            'user_id'   => $this->user_id,
            'description' => $this->description,
            'booth'     => $this->booth,
            'province'  => $this->province,
            'status'    => $this->status,
            'productAttribute' => $this->getProductAttribute(),
            'name_group_one' => $this->classification_group_one,
            'name_group_two' => json_decode($this->classification_group_two, true),
            'created_at' => $this->getCreatedAt(),
            'weight' => $this->weight,
            'length' => $this->length,
            'width'  => $this->width,
            'height' => $this->height,
        ];
    }

}
