<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected$fillable = [
        'super_admin',
        'image_1',
        'image_2',
        'image_3',
    ];
}
