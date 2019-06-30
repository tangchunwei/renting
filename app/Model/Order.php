<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['number','user_id','real_payment','type','state','service_charge','discount'];
}
