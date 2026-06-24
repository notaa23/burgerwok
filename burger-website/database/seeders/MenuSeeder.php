<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Topping;
use App\Models\SpiceLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $burger = Category::create(['name' => 'Burger', 'slug' => 'burger', 'icon' => 'heroicon-o-fire']);
        $kebab = Category::create(['name' => 'Kebab', 'slug' => 'kebab', 'icon' => 'heroicon-o-sparkles']);
        $side = Category::create(['name' => 'Side Dish', 'slug' => 'side-dish', 'icon' => 'heroicon-o-plus']);
        $drink = Category::create(['name' => 'Minuman', 'slug' => 'minuman', 'icon' => 'heroicon-o-beaker']);

        // Toppings
        $cheese = Topping::create(['name' => 'Keju', 'price' => 3000]);
        $mozzarella = Topping::create(['name' => 'Mozzarella', 'price' => 5000]);
        $egg = Topping::create(['name' => 'Telur', 'price' => 4000]);
        $beef = Topping::create(['name' => 'Daging Ekstra', 'price' => 8000]);
        $sausage = Topping::create(['name' => 'Sosis', 'price' => 5000]);

        // Spice Levels
        SpiceLevel::create(['name' => 'Tidak Pedas', 'description' => 'Tanpa cabai', 'level' => 1]);
        SpiceLevel::create(['name' => 'Pedas Ringan', 'description' => 'Sedikit cabai', 'level' => 2]);
        SpiceLevel::create(['name' => 'Pedas Sedang', 'description' => 'Pedas pas', 'level' => 3]);
        SpiceLevel::create(['name' => 'Pedas', 'description' => 'Pedas nampol', 'level' => 4]);
        SpiceLevel::create(['name' => 'Pedas Gila', 'description' => 'EXTREME!', 'level' => 5]);

        // Burger Menu
        $burger1 = Menu::create([
            'category_id' => $burger->id,
            'name' => 'Classic Burger',
            'slug' => 'classic-burger',
            'description' => 'Daging sapi segar, selada, tomat, saus spesial',
            'base_price' => 15000,
            'is_featured' => true,
        ]);
        $burger1->toppings()->attach([$cheese->id, $mozzarella->id, $egg->id]);

        $burger2 = Menu::create([
            'category_id' => $burger->id,
            'name' => 'Cheese Burger',
            'slug' => 'cheese-burger',
            'description' => 'Classic burger + keju melted',
            'base_price' => 18000,
        ]);
        $burger2->toppings()->attach([$cheese->id, $mozzarella->id, $beef->id]);

        $burger3 = Menu::create([
            'category_id' => $burger->id,
            'name' => 'Double Burger',
            'slug' => 'double-burger',
            'description' => 'Double daging sapi, double kepuasan',
            'base_price' => 25000,
            'is_featured' => true,
        ]);
        $burger3->toppings()->attach([$cheese->id, $egg->id, $beef->id]);

        // Kebab Menu
        $kebab1 = Menu::create([
            'category_id' => $kebab->id,
            'name' => 'Kebab Original',
            'slug' => 'kebab-original',
            'description' => 'Daging sapi kebab, sayuran segar, tortilla',
            'base_price' => 12000,
            'is_featured' => true,
        ]);
        $kebab1->toppings()->attach([$cheese->id, $beef->id]);

        $kebab2 = Menu::create([
            'category_id' => $kebab->id,
            'name' => 'Kebab Ayam',
            'slug' => 'kebab-ayam',
            'description' => 'Daging ayam berbumbu, sayuran, saus yogurt',
            'base_price' => 12000,
        ]);
        $kebab2->toppings()->attach([$cheese->id, $sausage->id]);

        $kebab3 = Menu::create([
            'category_id' => $kebab->id,
            'name' => 'Kebab Special',
            'slug' => 'kebab-special',
            'description' => 'Daging double, keju, saus BBQ',
            'base_price' => 18000,
            'is_featured' => true,
        ]);
        $kebab3->toppings()->attach([$cheese->id, $mozzarella->id, $beef->id]);

        // Sides
        Menu::create([
            'category_id' => $side->id,
            'name' => 'French Fries',
            'slug' => 'french-fries',
            'description' => 'Kentang goreng crispy',
            'base_price' => 8000,
        ]);

        Menu::create([
            'category_id' => $side->id,
            'name' => 'Onion Rings',
            'slug' => 'onion-rings',
            'description' => 'Bawang bombay goreng tepung',
            'base_price' => 10000,
        ]);

        // Drinks
        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Es Teh Manis',
            'slug' => 'es-teh-manis',
            'description' => 'Teh manis segar',
            'base_price' => 5000,
        ]);

        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Es Jeruk',
            'slug' => 'es-jeruk',
            'description' => 'Jeruk peras segar',
            'base_price' => 7000,
        ]);

        Menu::create([
            'category_id' => $drink->id,
            'name' => 'Mineral Water',
            'slug' => 'mineral-water',
            'description' => 'Air mineral dingin',
            'base_price' => 3000,
        ]);
    }
}