<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";
    protected $guarded = [];


    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {

        if ($this->type == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percentage') {
            return ($this->percent_off / 100) * $total;
        } else {
            return 0;
        }

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_users', 'user_id', 'coupon_id');
    }
}
