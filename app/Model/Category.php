<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name','parent_id','url','description','status','status_cus','draff','icon'];
	public function categories() {
		return $this->hasMany('App\Model\Category', 'parent_id','id');
	}
    public function parent() {
        return $this->belongsTo('App\Model\Category', 'parent_id', 'id');
    }
   public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
