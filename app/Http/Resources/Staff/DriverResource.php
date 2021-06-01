<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            "name"              => $this->full_name,
            "phone_number"      => $this->phone_number,
            "emergency_number"  => $this->emergency_number,
            "profile_pic"       => asset("/uploads/user_profiles/". $this->profile_pic),

        ];
    }
}
