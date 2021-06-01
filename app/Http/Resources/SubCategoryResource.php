<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SubCategoryResource extends Resource
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
            "slug"              => $this->slug,
            "type"              =>'Service',
            "is_available"      => $this->is_available,
            "service_id"        => $this->service_category_id,
            "description"       => $this->description,
            "discount_type"     => $this->discount_type,
            "price"             => $this->price,
            "addOns"            => AddOnResource::collection($this->addons),
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,

        ];
    }
}
