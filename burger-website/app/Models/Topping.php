<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = ['name', 'price', 'is_available'];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_topping')
                    ->withPivot('is_default', 'additional_price')
                    ->withTimestamps();
    }
}