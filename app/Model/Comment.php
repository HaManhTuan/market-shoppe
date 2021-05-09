<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'product_id',
    'customer_id',
    'content'];
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }
}
