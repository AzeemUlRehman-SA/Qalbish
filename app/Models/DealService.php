<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealService extends Model
{
    protected $table = "deal_services";
    protected $guarded = [];

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }

    public function deal_sub_categories()
    {
        return $this->hasMany(DealSubCategory::class, 'deal_service_category_id', 'id');
    }

    public function servies()
    {
        return $this->belongsTo(Category::class, 'service_category_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($deal) { // before delete() method call this

            // before delete() method call this
            $deal->deal_sub_categories()->detach();
        });
    }

}
