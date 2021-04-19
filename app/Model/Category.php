<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
	public $timestamps = true;
	public function categories() {
		return $this->hasMany('App\Model\Category', 'parent_id');
	}
   public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
