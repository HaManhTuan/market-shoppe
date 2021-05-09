<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $fillable = [
        'logo',
        'icon',
        'email',
        'address',
        'phone',
        'title',
        'description'
    ];
}
