<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id', 
        // 'inscurance_price',
        'shipping_price',
        'total_price',
        'transactions_status',
        'code',
        'dana',
        'total_ongkir',
        'status'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->BelongsTo(User::class, 'users_id', 'id');
    }
    public function product() {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }
}
