<?php

namespace Modules\AddressUsers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class AddressUsers extends JsonResource
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
            'address'   => $this->address,
            'phone'     => $this->phone,
            'status'    => $this->status,
            'province'  => $this->province,
            'district'  => $this->district,
            'ward'      => $this->ward,
        ];
    }
}
