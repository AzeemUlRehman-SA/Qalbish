<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded = [];

    public function areas(){
        return $this->hasMany(Area::class, 'city_id', 'id');
    }
}
