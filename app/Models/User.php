<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'city_id', 'area_id', 'role_id', 'category_id', 'dob', 'age', 'phone_number', 'emergency_number', 'cnic', 'address', 'referral_code', 'user_type', 'status', 'profile_pic', 'otp_code', 'current_address', 'latitude', 'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    public function user_referrals()
    {
        return $this->hasMany(UserReferral::class, 'user_id', 'id');
    }
    public function user_referred_to()
    {
        return $this->hasMany(UserReferral::class, 'referred_id', 'id');
    }



    public function pending_user_referrals()
    {
        return $this->user_referrals()->where('status', 'pending');
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function referral_code()
    {
        return $this->referral_code;
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class, 'user_id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'category_id', 'id');
    }


    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'user_id', 'coupon_id');
    }

    public function membershipDiscount()
    {
        return $this->belongsTo(MembershipDiscount::class, 'membership_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function completedOrders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id')->where('order_status', 'completed');
    }



    public function order_staff()
    {
        return $this->hasOne(Order::class, 'staff_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

//     $this->middleware('role:SUPER_ADMIN');
//      $this->middleware('role:STAFF');
//      $this->middleware('role:CUSTOMER');
//      $this->middleware('role:DRIVER');

}
