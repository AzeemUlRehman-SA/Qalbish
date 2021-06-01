<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $category_name = Service::where('id', $this->category_id)->first();

        if ((!is_null(auth()->user()->profile_pic))) {
            $profile_pic = auth()->user()->profile_pic;
        } else {
            $profile_pic = 'default.png';
        }
        return [
            "id" => $this->id,
            "name" => $this->first_name . " " . $this->last_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "city_id" => $this->city_id,
            "city_name" => $this->city->name,
            "area_id" => $this->area_id,
            "area_name" => !is_null($this->area) ? $this->area->name : null,
            "dob" => $this->dob,
            "age" => $this->age,
            "category_id" => $this->category_id,
            "gender" => $category_name->name,
            "phone_number" => $this->phone_number,
            "emergency_number" => $this->emergency_number,
            "cnic" => $this->cnic,
            "address" => $this->address,
            "referral_code" => $this->referral_code,
            "user_type" => $this->user_type,
            "status" => $this->status,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "delivery_charges" => !is_null($this->area) ? (int)$this->area->price : null,
            "profile_pic" => asset("/uploads/user_profiles/" . $profile_pic),


        ];
    }
}
