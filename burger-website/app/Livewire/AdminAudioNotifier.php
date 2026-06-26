<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class AdminAudioNotifier extends Component
{
    public $lastOrderCount = 0;

    public function mount()
    {
        $this->lastOrderCount = $this->getPendingOrderCount();
    }

    public function checkNewOrders()
    {
        $currentCount = $this->getPendingOrderCount();

        if ($currentCount > $this->lastOrderCount) {
            $this->dispatch('play-new-order-sound');
        }

        $this->lastOrderCount = $currentCount;
    }

    private function getPendingOrderCount()
    {
        // Menghitung jumlah pesanan yang statusnya pending atau sedang diproses
        return Order::whereIn('order_status', ['pending', 'processing'])->count();
    }

    public function render()
    {
        return view('livewire.admin-audio-notifier');
    }
}
