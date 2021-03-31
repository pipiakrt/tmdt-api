<?php

namespace Modules\Orders\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Orders extends JsonResource
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
            'guest_name' => $this->guest_name,
            'guest_phone' => $this->guest_phone,
            'guest_address' => $this->guest_address,
            'code' => $this->code,
            'note' => $this->note,
            'booth_id' => $this->booth_id,
            'guest_email' => $this->guest_email,
            'OrderDetail' => $this->getOrderDetail(),
            'orderHistory' => $this->orderHistory,
            'ship_price'     => $this->ship_price,
            'booth'     => $this->booth,
            'products' => $this->products,
            'total' => $this->total,
            'status' => $this->status,
            'orderStatus' => $this->orderStatus,
            'orderUsers' => $this->orderUsers,
            'province'  => $this->province,
            'district'  => $this->district,
            'ward'  => $this->ward,
            'created_at' => $this->created_at,
            'status_pay' => $this->status_pay,
            'payment' => $this->payment,
            'estimated_pick_time' => $this->estimated_pick_time,
            'estimated_deliver_time' => $this->estimated_deliver_time,
            'delivery' => $this->id_delivery,
            'transports' => $this->transport,
        ];

    }
}
