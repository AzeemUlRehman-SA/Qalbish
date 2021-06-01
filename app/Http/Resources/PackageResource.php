<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            "id"                => $this->id,
            "name"              => $this->name,
            "slug"              => $this->slug,
            "is_available"      => $this->is_available,
            "type"              => 'Package',
            "category_id"       => $this->category_id,
            "image"             => asset('/uploads/service_category/' . $this->image),
            "thumbnail"         => asset('/uploads/packages/thumbnails/' . $this->image),
            "thumbnail_mobile"  => asset('/uploads/packages/thumbnails_mobiles/' . $this->image),
            "net_price"         => $this->net_price,
            "total_price"       => $this->total_price,
            "package_services"  => PackageServicesResource::collection($this->deal_services),
        ];
    }
}
