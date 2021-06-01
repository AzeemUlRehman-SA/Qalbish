<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ((!is_null($this->profile_pic))) {
            $profile_pic = $this->profile_pic;
        } else {
            $profile_pic = 'default.png';
        }
        return [
            "id" => $this->id,
            "name" => $this->fullName(),
            "phone_number" => $this->phone_number,
            "emergency_number" => $this->emergency_number,
            "profile_pic" => asset("/uploads/user_profiles/" . $profile_pic),

        ];
    }
}
