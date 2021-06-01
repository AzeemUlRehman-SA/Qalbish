<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "amount"            => $this->amount,
            "type"              => $this->type,
            "quantity"          => $this->quantity,
            "name"              => $this->name,
            "service_id"        => $this->service_id,
            "package_id"        => $this->package_id,
            "addOns"            => OrderedServiceCategoryAddonResource::collection($this->order_menu_items_addons)
        ];
    }
}
