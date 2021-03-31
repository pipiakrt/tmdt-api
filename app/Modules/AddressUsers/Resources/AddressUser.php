<?php

namespace Modules\AddressUsers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressUser extends JsonResource
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
        $array['province'] = $this->province;
        $array['district'] = $this->district;
        $array['ward'] = $this->ward;
        return $array;
    }
}
