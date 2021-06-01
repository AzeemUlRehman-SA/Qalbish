<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = "roles";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_role')->withTimestamps();
    }
}
