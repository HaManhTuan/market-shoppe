<?php

namespace App;

use App\Model\OrderUser;
use App\Model\Province;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\Product;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function province()
    {
       return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'author_id', 'id');
    }

    public function order_user()
    {
        return $this->hasMany(OrderUser::class, 'user_id', 'id');
    }
}
