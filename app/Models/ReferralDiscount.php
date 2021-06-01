<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralDiscount extends Model
{
    protected $table = "referral_discounts";
    protected $guarded = [];

    public function discount($total)
    {

        if ($this->type == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percent') {
            return ($this->percent_off / 100) * $total;
        } else {
            return 0;
        }

    }
}
