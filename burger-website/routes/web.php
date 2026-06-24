<?php

use App\Livewire\MenuCatalog;
use Illuminate\Support\Facades\Route;
use App\Livewire\CartPage;

Route::get('/', MenuCatalog::class)->name('home');
Route::get('/cart', CartPage::class)->name('cart');