<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageSubCategoriesResource extends JsonResource
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
            "sub_category"                  => $this->sub_category,
            "deal_sub_category_addons"      => PackageSubCategoryAddonsResource::collection($this->deal_sub_category_addons)
        ];
    }
}
