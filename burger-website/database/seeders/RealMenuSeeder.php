<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Topping;
use Illuminate\Support\Str;

class RealMenuSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan data lama dengan hati-hati (tanpa truncate untuk menghindari foreign key issues)
        DB::table('order_item_toppings')->delete();
        DB::table('order_items')->delete();
        DB::table('orders')->delete();
        DB::table('menu_topping')->delete();
        DB::table('menus')->delete();
        DB::table('categories')->delete();
        DB::table('toppings')->delete();

        // 1. Kategori
        $catBurger = Category::create([
            'name' => 'Burger & Lainnya',
            'slug' => 'burger-dan-lainnya',
            'icon' => '🍔'
        ]);

        $catKebab = Category::create([
            'name' => 'Kebab',
            'slug' => 'kebab',
            'icon' => '🌯'
        ]);

        // 2. Topping
        $topKeju = Topping::create(['name' => 'Ekstra Keju', 'price' => 2000]);
        $topDaging = Topping::create(['name' => 'Ekstra Daging', 'price' => 4000]);
        $topSosis = Topping::create(['name' => 'Ekstra Sosis', 'price' => 3000]);

        // 3. Menus (Burger & Lainnya)
        $burgerMenus = [
            ['name' => 'Roti Bakar Coklat', 'price' => 2000, 'img' => 'roti_bakar.png'],
            ['name' => 'Roti Bakar Blueberry', 'price' => 2000, 'img' => 'roti_bakar.png'],
            ['name' => 'Roti Bakar Coklat Keju', 'price' => 4000, 'img' => 'roti_bakar.png'],
            ['name' => 'Sostel', 'price' => 5000, 'img' => 'sostel.png'],
            ['name' => 'Burger Telur', 'price' => 5000, 'img' => 'burger_xxl.png'],
            ['name' => 'Burger Daging', 'price' => 5000, 'img' => 'burger_xxl.png'],
            ['name' => 'Burger Biasa', 'price' => 6000, 'img' => 'burger_xxl.png'], // daging + telur
            ['name' => 'Burger Spesial', 'price' => 8000, 'img' => 'burger_xxl.png'], // daging + telur + sosis
            ['name' => 'Burger XXL', 'price' => 16000, 'img' => 'burger_xxl.png'], // double semua
        ];

        foreach ($burgerMenus as $m) {
            $menu = Menu::create([
                'category_id' => $catBurger->id,
                'name' => $m['name'],
                'slug' => Str::slug($m['name']),
                'description' => 'Sajian lezat dari Burger Kebab MAN yang siap menggoyang lidah Anda.',
                'base_price' => $m['price'],
                'image' => 'menus/' . $m['img'],
                'is_available' => true,
                'is_featured' => str_contains($m['name'], 'XXL') || str_contains($m['name'], 'Spesial')
            ]);
            $menu->toppings()->attach([$topKeju->id, $topDaging->id, $topSosis->id]);
        }

        // 4. Menus (Kebab)
        $kebabMenus = [
            ['name' => 'Kebab Sosis', 'price' => 5000, 'img' => 'kebab_sultan.png'],
            ['name' => 'Kebab Telur', 'price' => 6000, 'img' => 'kebab_sultan.png'],
            ['name' => 'Kebab Biasa', 'price' => 7000, 'img' => 'kebab_sultan.png'], // sosis + daging
            ['name' => 'Kebab Kampus', 'price' => 10000, 'img' => 'kebab_sultan.png'], // daging + telur
            ['name' => 'Kebab Sultan', 'price' => 13000, 'img' => 'kebab_sultan.png'], // sosis + daging + telur
        ];

        foreach ($kebabMenus as $m) {
            $menu = Menu::create([
                'category_id' => $catKebab->id,
                'name' => $m['name'],
                'slug' => Str::slug($m['name']),
                'description' => 'Kebab premium dengan isian melimpah khas Burger Kebab MAN.',
                'base_price' => $m['price'],
                'image' => 'menus/' . $m['img'],
                'is_available' => true,
                'is_featured' => str_contains($m['name'], 'Sultan') || str_contains($m['name'], 'Kampus')
            ]);
            $menu->toppings()->attach([$topKeju->id, $topDaging->id, $topSosis->id]);
        }
    }
}
