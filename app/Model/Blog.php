<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  protected $table    = 'blog';
  protected $fillable = ['name','author_id', 'description', 'status', 'image','content'];
  public $timestamps  = true;
  public function user() {
    return $this->belongsTo('App\User', 'author_id', 'id');
  }
}
