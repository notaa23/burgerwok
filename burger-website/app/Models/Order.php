<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone',
        'subtotal', 'total', 'payment_method', 'payment_status',
        'order_status', 'payment_proof', 'notes'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}