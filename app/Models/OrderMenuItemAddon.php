<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderMenuItemAddon extends Model
{

    protected $table = "ordered_menu_items_addons";
    protected $guarded = [];

    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_details_id', 'id');
    }

    public function addOns(){
        return $this->belongsTo(AddOn::class, 'add_on_id', 'id');
    }
}
