<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealSubCategoryAddon extends Model
{
    protected $table = "deal_sub_categories_addons";
    protected $guarded = [];

    public function deal_sub_category()
    {

        return $this->belongsTo(DealSubCategory::class, 'deals_sub_category_id', 'id');
    }

    public function addon()
    {
        return $this->belongsTo(AddOn::class, 'addon_id', 'id');
    }
}
