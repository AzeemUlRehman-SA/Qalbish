<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "is_available" => $this->is_available,
            "service_id" => $this->service_id,
            "image" => asset('/uploads/service_category/' . $this->image),
            "thumbnail" => asset('/uploads/service_category/thumbnails/' . $this->thumbnail_image),
            "thumbnail_mobile" => asset('/uploads/service_category/thumbnails_mobiles/' . $this->thumbnail_image),
            "description" => $this->description,
            "discount_type" => $this->discount_type,
            "discount_price" => $this->discount_price,
            "sub_categories" => SubCategoryResource::collection($this->sub_categories),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
