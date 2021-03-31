<?php

namespace Modules\Favourite\Resources;

use App\Models\Province;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Provinces\Resources\Provinces;

class Favourite extends JsonResource
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
        $array['product']        = $this->product;
        $array['province']        = $this->product->province;
        return $array;
    }
}
