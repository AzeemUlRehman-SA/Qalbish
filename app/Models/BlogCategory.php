<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    protected $table = "blog_categories";
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::deleting(function ($sub_category) { // before delete() method call this
//            $sub_category->blogs()->detach();
//        });
//    }
}
