<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipDiscount extends Model
{

    protected $table = "membership_discounts";
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
