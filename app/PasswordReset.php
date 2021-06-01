<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey   = null;
    public $incrementing    = false;
    public $timestamps      = false;

    protected $fillable = array('email', 'token');

}
