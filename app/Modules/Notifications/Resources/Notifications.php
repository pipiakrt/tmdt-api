<?php

namespace Modules\Notifications\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer id
 * @property string username
 */

class Notifications extends JsonResource
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
            'id' => $this->_id,
            'to_id' => $this->to_id,
            'to_name' => $this->to_name,
            'from_id' => $this->from_id,
            'from_name' => $this->from_name,
            'title' => $this->title,
            'content' => $this->content,
            'seen' => $this->seen,
            'status' => $this->status,
            'created_at' => date('h:i d/m/Y', strtotime($this->created_at))
        ];
    }
}
