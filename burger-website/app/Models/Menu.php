<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'base_price', 'image', 'is_available', 'is_featured'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'menu_topping')
                    ->withPivot('is_default', 'additional_price')
                    ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}