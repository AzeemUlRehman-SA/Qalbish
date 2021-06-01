<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealSubCategory extends Model
{

    protected $table = "deals_sub_categories";
    protected $guarded = [];

    public function deal_service()
    {
        return $this->belongsTo(DealService::class, 'deal_service_category_id', 'id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function deal_sub_category_addons()
    {
        return $this->hasMany(DealSubCategoryAddon::class, 'deals_sub_category_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($deal) {
            foreach ($deal->deal_sub_category_addons() as $check_object_check) {
                // before delete() method call this
                $check_object_check->delete();
            }


        });
    }


}
