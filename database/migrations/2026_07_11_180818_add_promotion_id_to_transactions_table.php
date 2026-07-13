<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Taruh di bawah kolom member_id agar struktur database tetap rapi
            $table->foreignId('promotion_id')
                ->nullable()
                ->after('member_id')
                ->constrained('promotions')
                ->nullOnDelete();

            // Kolom untuk melacak berapa nominal potongan yang didapat dari promosi ini
            $table->integer('promotion_discount_amount')
                ->default(0)
                ->after('subtotal');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['promotion_id']);
            $table->dropColumn(['promotion_id', 'promotion_discount_amount']);
        });
    }
};
