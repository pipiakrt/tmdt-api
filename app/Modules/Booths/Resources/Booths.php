<?php

namespace Modules\Booths\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Booths extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->getCreatedAt(),
            // 'province_id' => $this->province('name'),
            // 'district_id' => $this->district('name'),
            // 'ward_id' => $this->ward->name,
        ];
    }
}
