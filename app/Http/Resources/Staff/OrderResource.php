<?php

namespace App\Http\Resources\Staff;

use App\Http\Resources\UserResource;
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
            "order_id"              => $this->order_id,
            "total_price"           => $this->total_price,
            "grand_total"           => $this->grand_total,
            "coupon_discount"       => $this->coupon_discount,
            "referral_discount"     => $this->referral_discount,
            "first_order_discount"  => $this->first_order_discount,
            "membership_discount"   => $this->membership_discount,
            "admin_discount"        => $this->admin_discount,
            "order_status"          => $this->order_status,
            "staff_status"          => $this->staff_status,
            "order_progress_status" => $this->order_progress_status,
            "total_discount"        => $this->coupon_discount + $this->referral_discount + $this->first_order_discount + $this->membership_discount + $this->admin_discount,
            "order_date_time"       => date('M d, Y, h:i:s A', strtotime($this->requested_date_time)),
            "order_date"            => $date,
            "order_time"            => date('h:i A', strtotime($this->requested_date_time)),
            "special_instruction"   => $this->special_instruction,
            "address"               => $this->address,
            "alternate_address"     => $this->alternate_address ?? "",
            "phone_number"          => $this->phone_number,
            "total_persons"         => $this->total_persons,
            "city"                  => $this->city->name,
            "area"                  => $this->area->name,
            "full_address"          => $this->address . ", " . $this->area->name . ", " . $this->city->name,
            "order_detail"          => OrderDetailResource::collection($this->order_details),
            "customer"              => new UserResource($this->user),
            "driver"                => new DriverResource($this->driver),
            "staff"                 => new StaffResource($this->staff),
            "rating"                => new RatingResource($this->rating),

        ];
    }
}
