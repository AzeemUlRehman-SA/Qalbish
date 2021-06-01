<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    protected $table = "testimonials";
    protected $guarded = [];
}
