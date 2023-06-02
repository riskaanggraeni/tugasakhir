<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id',
        'insurance_price',
        'shipping_price',
        'total_price',
        'code'
    ];

    protected $hidden = [

    ];
}
