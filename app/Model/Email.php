<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected  $fillable = ['is_send_mail_cart','is_send_mail_product_expried'];
}
