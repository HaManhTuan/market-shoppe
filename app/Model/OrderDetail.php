<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
  protected $table   = 'orderdetail';
  public $timestamps = true;
  public function product() {
    return $this->belongsTo('App\Model\Product', 'product_id', 'id');
  }
}
