<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AddOnResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        parent::toArray($request);

        return [
            "id"                => $this->id,
            "name"              => $this->name,
            "sub_category_id"   => $this->service_sub_category_id,
            "slug"              => $this->slug,
            "price"             => $this->price,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,

        ];
    }
}
