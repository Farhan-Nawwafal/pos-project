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
        Schema::create('card_payments', function (Blueprint $table) {
            $table->id();
            // Hubungan ke tabel transactions
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->unsignedBigInteger('cabang_id');

            // Kolom detail data kartu
            $table->bigInteger('amount');
            $table->string('card_number');
            $table->string('verification_code');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('self_order_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_payments');
    }
};
