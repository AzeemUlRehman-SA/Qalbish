<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $guarded = [];
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
