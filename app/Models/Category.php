<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "service_categories";
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, 'service_category_id', 'id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'service_category_id', 'id');
    }

    public function countBlogs()
    {
        return $this->blogs()->count();
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'category_id', 'id');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_services', 'staff_id', 'service_category_id');
    }

    public function deal_services()
    {
        return $this->hasMany(DealService::class, 'service_category_id', 'id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'service_id', 'id');
    }



}
