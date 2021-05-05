<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    public function ward()
    {
       return $this->belongsTo(Ward::class, 'district_id','id');
    }
}
