<?php

namespace Modules\Booths\Resources;

use FontLib\Table\Type\name;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Booth extends JsonResource
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
        $array['created_at'] = $this->getCreatedAt();
        $array['avatar'] = Storage::url($this->avatar);
        $array['cover'] = Storage::url($this->cover);
        $array['province'] = $this->province;
        $array['district'] = $this->district;
        $array['ward'] = $this->ward;
        return $array;
    }
}
