<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table   = 'order';
  public $timestamps = true;
  public function orders() {
    return $this->hasMany('App\Model\OrderDetail', 'order_id');
  }
  public function customer() {
    return $this->belongsTo('App\Model\Customer', 'customer_id', 'id');
  }
}
