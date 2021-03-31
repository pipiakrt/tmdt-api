<?php

namespace Modules\Products\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $array['url_serve'] = url('/');
        $array['avatar'] = \Storage::url($this->avatar);
        $array['price'] = $this->price;
        $array['discount'] = $this->discount;
        $array['category'] = $this->categories;
        $array['product_attribute'] = $this->productAttribute;
        $array['attribute_detail'] = $this->productAttribute;
        $array['images'] = [];
        foreach ($this->images as $ke_i => $image){
            $array['images'][$ke_i]['url'] = $image['url'];
            $array['images'][$ke_i]['id'] = $image['id'];
        }
        $array['countImage'] = count($this->images);
        $array['province'] = $this->booth->province;
        $array['origin'] = $this->origin;
        $array['condition'] = $this->condition;
        $array['booth'] = $this->booth;
//        $array['province'] = $this->booth->province;
        $array['star'] = $this->star;
        $array['favourite'] = $this->favourite;
        $array['checkfavourite'] = $this->favourite();
        $array['classification_group_two'] = json_decode($this->classification_group_two);
        $array['productAttribute'] = $this->getProductAttribute();
        $array['count'] = $this->Count();
        return $array;
    }
}
