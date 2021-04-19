<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table    = 'product';
	protected $fillable = ['name', 'url', 'stock', 'category_id','author_id', 'description', 'status', 'image', 'price', 'promotional_price', 'sale','content','author_id','brand_id'];
	public $timestamps  = true;
	public function attributes() {
		return $this->hasMany('App\Model\ProductAttr', 'product_id');
	}
	public function category() {
		return $this->belongsTo('App\Model\Category', 'category_id', 'id');
	}
	public function brand() {
		return $this->belongsTo('App\Model\Brand', 'brand_id', 'id');
	}
	public function user() {
		return $this->belongsTo('App\User', 'author_id', 'id');
	}
}
