<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "order_staff_rating";
    protected $guarded = [];


    public function order()
    {
        return $this->belongsTo(Rating::class, 'order_id', 'id');
    }
}
