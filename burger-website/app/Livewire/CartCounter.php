<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class CartCounter extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->count = app(CartService::class)->count();
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}