<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_topping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topping_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_default')->default(false);
            $table->integer('additional_price')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_topping');
    }
};