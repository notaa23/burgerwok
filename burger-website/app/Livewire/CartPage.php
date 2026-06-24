<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class CartPage extends Component
{
    public $items = [];
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $cart = app(CartService::class);
        $this->items = $cart->getItems();
        $this->total = $cart->getTotal();
    }

    public function remove($id)
    {
        app(CartService::class)->remove($id);
        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function clear()
    {
        app(CartService::class)->clear();
        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}