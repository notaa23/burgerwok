<?php
// FILE: routes/web.php

use App\Livewire\MenuCatalog;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\PaymentPage;
use App\Livewire\OrderStatusPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route untuk Burger Kebab MAN
*/

Route::get('/', MenuCatalog::class)->name('home');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/payment/{orderNumber}', PaymentPage::class)->name('payment');
Route::get('/order-status/{orderNumber?}', OrderStatusPage::class)->name('order-status');

Route::get('/order-success/{orderNumber}', function ($orderNumber) {
    return view('order-success', ['orderNumber' => $orderNumber]);
})->name('order-success');