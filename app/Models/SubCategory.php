<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $table = "service_sub_categories";
    protected $guarded = [];

    public function deal_sub_categories()
    {
        return $this->hasMany(DealSubCategory::class, 'sub_category_id', 'id');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::deleting(function ($sub_category) { // before delete() method call this
//            $sub_category->deals()->detach();
//        });
//    }

    public function addons()
    {
        return $this->hasMany(AddOn::class, 'service_sub_category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'service_category_id', 'id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'menu_item_id', 'id');
    }


}
