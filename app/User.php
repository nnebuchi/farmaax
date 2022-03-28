<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'username', 'phone',  'email', 'password', 'wallet_id', 'parent', 'referral_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function visitcount()
    {
        return $this->hasMany(VisitCount::class);
    }
    public function totalPoints()
    {
        return floor($this->visitcount()->count() / 10);
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profileImg()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->firstName . '+' . $this->lastName);
    }
    public function name()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function investment_cart()
    {
        return $this->hasMany(Investment_cart::class);
    }
}
