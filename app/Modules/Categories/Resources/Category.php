<?php

namespace Modules\Categories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
        $array['id']        = $this->id;
        $array['name']      = $this->title;
        $array['slug']      = $this->slug;
        $array['avatar']    = $this->url;

        return $array;
    }
}
