<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddOn extends Model
{
    use SoftDeletes;
    protected $table = "service_sub_categories_add_ons";
    protected $guarded = [];

    public function service_sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'service_sub_category_id', 'id');
    }

    public function deal_sub_category_addons()
    {
        return $this->hasMany(DealSubCategoryAddon::class, 'addon_id', 'id');
    }

    public function ordered_menu_items_addons()
    {
        return $this->hasMany(AddOn::class, 'add_on_id', 'id');
    }
}
