<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $table = "order_details";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function order_menu_items_addons()
    {
        return $this->hasMany(OrderMenuItemAddon::class, 'order_details_id', 'id');
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class, 'menu_item_id', 'id');
    }

    public function service_category(){
        return $this->belongsTo(Category::class, 'service_id', 'id');
    }
}
