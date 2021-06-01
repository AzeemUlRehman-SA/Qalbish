<?php

namespace App\Models;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $guarded = [];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
}
