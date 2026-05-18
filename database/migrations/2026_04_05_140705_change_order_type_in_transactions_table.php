<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Opsi 1: Ubah ke String (Lebih disarankan agar tidak gampang error lagi)
            $table->string('order_type')->change();

            // Opsi 2: Tetap ENUM tapi tambahkan 'take_away'
            // $table->enum('order_type', ['dine_in', 'take_away', 'quick_service'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Balikin ke enum lama jika di rollback
            $table->enum('order_type', ['dine_in', 'quick_service'])->change();
        });
    }
};
