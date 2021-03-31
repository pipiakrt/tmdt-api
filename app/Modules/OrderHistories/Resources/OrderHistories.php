<?php

namespace Modules\OrderHistories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class OrderHistories extends JsonResource
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
            'created_at' => $this->getCreatedAt(),
            'order_id' => $this->order_id,
            'order_status_id'=> $this->order_status_id,
            'order_status'=> $this->orderStatus,
            // 'order'=>$this->order,

        ];
    }
}
