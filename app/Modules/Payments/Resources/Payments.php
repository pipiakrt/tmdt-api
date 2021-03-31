<?php

namespace Modules\Payments\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Payments extends JsonResource
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
            'status'    => $this->status,
            'type'      => $this->type,
        ];
    }
}
