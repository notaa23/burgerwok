<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentPage extends Component
{
    use WithFileUploads;

    public $order;
    public $orderNumber;
    public $paymentProof;

    public function mount($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        $this->order = Order::where('order_number', $orderNumber)->firstOrFail();
    }

    public function uploadProof()
    {
        $this->validate([
            'paymentProof' => 'required|image|max:2048',
        ]);

        $path = $this->paymentProof->store('payment-proofs', 'public');
        
        $this->order->update([
            'payment_proof' => $path,
            'payment_status' => 'waiting_confirmation',
        ]);

        // Kirim notifikasi ke admin
        Notification::make()
            ->title('Bukti Bayar Diterima! 📸')
            ->body('Pesanan ' . $this->order->order_number . ' dari ' . $this->order->customer_name . ' telah upload bukti pembayaran. Segera konfirmasi!')
            ->warning()
            ->sendToDatabase(User::all());

        session()->flash('success', 'Bukti pembayaran berhasil diupload! Admin akan segera konfirmasi.');
        return redirect('/order-status/' . $this->orderNumber);
    }

    public function render()
    {
        return view('livewire.payment-page');
    }
}