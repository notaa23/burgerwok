<?php

namespace App\Services;

class CartService
{
    public function getItems()
    {
        return session()->get('cart.items', []);
    }

    public function add($menuId, $name, $price, $qty, $spiceLevel, $toppings, $notes)
    {
        $items = $this->getItems();
        
        $items[] = [
            'id' => uniqid(),
            'menu_id' => $menuId,
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'spice_level' => $spiceLevel,
            'toppings' => $toppings,
            'notes' => $notes,
        ];
        
        session()->put('cart.items', $items);
    }

    public function remove($id)
    {
        $items = $this->getItems();
        $items = array_filter($items, fn($item) => $item['id'] !== $id);
        session()->put('cart.items', array_values($items));
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $toppingTotal = 0;
            foreach ($item['toppings'] as $topping) {
                $toppingTotal += $topping['price'];
            }
            $total += ($item['price'] + $toppingTotal) * $item['qty'];
        }
        return $total;
    }

    public function count()
    {
        return count($this->getItems());
    }

    public function clear()
    {
        session()->forget('cart');
    }
}