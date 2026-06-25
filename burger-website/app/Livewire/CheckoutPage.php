<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemTopping;
use App\Services\CartService;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $name = '';
    public $whatsapp = '';
    public $paymentMethod = '';
    public $notes = '';
    public $items = [];
    public $total = 0;

    protected $rules = [
        'name' => 'required|min:3',
        'whatsapp' => 'required|regex:/^08[0-9]{8,11}$/',
        'paymentMethod' => 'required|in:qris,transfer,cod',
    ];

    public function mount()
    {
        $cart = app(CartService::class);
        $this->items = $cart->getItems();
        $this->total = $cart->getTotal();

        if (empty($this->items)) {
            return redirect('/cart');
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $cart = app(CartService::class);
        $items = $cart->getItems();
        $total = $cart->getTotal();

        // Simpan order
        $order = Order::create([
            'order_number' => 'BKB-' . date('Ymd') . '-' . rand(1000, 9999),
            'customer_name' => $this->name,
            'customer_phone' => $this->whatsapp,
            'subtotal' => $total,
            'total' => $total,
            'payment_method' => $this->paymentMethod,
            'payment_status' => $this->paymentMethod === 'cod' ? 'confirmed' : 'pending',
            'order_status' => 'pending',
            'notes' => $this->notes,
        ]);

        // Simpan order items
        foreach ($items as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['qty'],
                'base_price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
                'spice_level_id' => $item['spice_level']['id'] ?? 1,
                'notes' => $item['notes'],
            ]);

            // Simpan toppings
            foreach ($item['toppings'] as $topping) {
                OrderItemTopping::create([
                    'order_item_id' => $orderItem->id,
                    'topping_id' => $topping['id'],
                    'name' => $topping['name'],
                    'price' => $topping['price'],
                ]);
            }
        }

        // Kosongkan cart
        $cart->clear();
        $this->dispatch('cartUpdated');

        return redirect('/order-success/' . $order->order_number);
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}