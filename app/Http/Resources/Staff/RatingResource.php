<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            "time"              => $this->rate_star_1,
            "professionalism"   => $this->rate_star_2,
            "service"           => $this->rate_star_3,
        ];
    }
}
