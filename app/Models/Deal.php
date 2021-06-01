<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes;
    protected $table = "deals";
    protected $guarded = [];


    public function categories()
    {

        return $this->belongsTo(Service::class, 'category_id', 'id');
    }

    public function deal_services()
    {
        return $this->hasMany(DealService::class, 'deal_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($deal) { // before delete() method call this
//            $deal->deal_services()->detach();

            foreach ($deal->deal_services() as $check_object_check) {
                // before delete() method call this
                $check_object_check->delete();
            }

        });
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'package_id', 'id');
    }


}
