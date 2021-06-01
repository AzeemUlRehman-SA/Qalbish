<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $table = "services";
    protected $guarded = [];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'category_id', 'id');
    }

}
