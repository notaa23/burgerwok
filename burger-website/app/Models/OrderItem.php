<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'menu_id', 'quantity', 'base_price',
        'subtotal', 'spice_level_id', 'notes'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function spiceLevel()
    {
        return $this->belongsTo(SpiceLevel::class);
    }

    public function toppings()
    {
        return $this->hasMany(OrderItemTopping::class);
    }
}