<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemTopping extends Model
{
    protected $fillable = ['order_item_id', 'topping_id', 'name', 'price'];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function topping()
    {
        return $this->belongsTo(Topping::class);
    }
}