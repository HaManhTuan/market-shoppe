<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    protected $table   = 'order_users';

    public function orders() {
      return $this->hasMany('App\Model\OrderDetailUser', 'order_user_id');
    }
    public function customer() {
      return $this->belongsTo('App\Model\Customer', 'customer_id', 'id');
    }
}
