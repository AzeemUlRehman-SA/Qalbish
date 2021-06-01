<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstOrderDiscount extends Model
{

    protected $table = "first_order_discounts";
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
