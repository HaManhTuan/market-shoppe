<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ['description','category_id','discount','status','start_date','end_date'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }
}
