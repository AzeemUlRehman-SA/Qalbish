<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date= explode(' ',$this->requested_date_time)[0];
        $time= explode(' ',$this->requested_date_time)[1];
        return [
            "id"                    => $this->id,
            "total_price"           => $this->total_price,
            "order_status"          => $this->order_status,
//            "order_date_time"       => date('M d, Y, h:i:s A', strtotime($this->requested_date_time)),
            "order_date"            => date('M d, Y', strtotime($date)),
            "order_time"            => $time,
            "address"               => $this->address,
            "alternate_address"     => $this->alternate_address ?? "",
            "phone_number"          => $this->phone_number,
            "total_persons"         => $this->total_persons,
            "city"                  => $this->city->name,
            "area"                  => $this->area->name,
            "full_address"          => $this->address . ", " . $this->area->name . ", " . $this->city->name,

        ];
    }
}
