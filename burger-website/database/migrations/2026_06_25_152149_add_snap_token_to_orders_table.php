<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('notes');
        });
        
        // Memperbarui enum untuk mendukung midtrans
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('qris', 'transfer', 'cod', 'midtrans')");
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('snap_token');
        });
        
        // Kembalikan enum ke semula
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('qris', 'transfer', 'cod')");
    }
};
