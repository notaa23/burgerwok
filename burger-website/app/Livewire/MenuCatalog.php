<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Menu;
use App\Services\CartService;
use Livewire\Component;

class MenuCatalog extends Component
{
    public $selectedCategory = null;
    public $search = '';

    protected function getListeners()
    {
        return [
            'addToCartCustom' => 'handleAddToCart',
        ];
    }

    public function handleAddToCart($menuId, $name, $price, $qty, $spiceLevel, $toppings, $notes)
    {
        $cart = app(CartService::class);
        
        $cart->add(
            $menuId,
            $name,
            $price,
            $qty,
            $spiceLevel,
            $toppings,
            $notes
        );
        
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        $categories = Category::all();
        
        $menus = Menu::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->with('category', 'toppings')
            ->get();

        return view('livewire.menu-catalog', [
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function resetFilter()
    {
        $this->selectedCategory = null;
        $this->search = '';
    }
}