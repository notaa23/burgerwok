<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderStatusPage extends Component
{
    public $order;

    public function mount($orderNumber = null)
    {
        if ($orderNumber) {
            $this->order = Order::where('order_number', $orderNumber)->firstOrFail();
        }
    }

    public function checkOrder($orderNumber)
    {
        return redirect('/order-status/' . $orderNumber);
    }

    public function render()
    {
        return view('livewire.order-status-page');
    }
}