<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    protected $table = 'user_referral';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referredTo()
    {
        return $this->belongsTo(User::class, 'referred_id', 'id');
    }
}
