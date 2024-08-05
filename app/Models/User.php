<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ifn_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'package_id',
        'role',
        'active',
        'token',
        'subscriber',
        'profile_image',
        'package_price_id',
        'remember_me'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function user_details()
    {
        return $this->hasOne(UserDetails::class, 'user_id' , 'user_id');
    }

    public function Package_detail()
    {
        return $this->hasOne(Packages::class, 'package_id' , 'package_id');
    }

    public function subscribe_package()
    {
        return $this->hasOne(Subscriber::class, 'user_id' , 'user_id');
    }


    public function subscribe_package_price()
    {
        return $this->hasOne(PackagePrice::class, 'id' , 'package_price_id');
    }

}
