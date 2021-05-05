<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

    public function district()
    {
       return $this->belongsTo(District::class, 'province_id','id');
    }
}
