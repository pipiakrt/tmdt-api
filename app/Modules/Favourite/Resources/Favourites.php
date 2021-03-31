<?php

namespace Modules\Favourites\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Favourites extends JsonResource
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
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
        ];
    }
}
