<?php

namespace Modules\AttributeDetails\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeDetail extends JsonResource
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
        
        return $array;
    }
}
