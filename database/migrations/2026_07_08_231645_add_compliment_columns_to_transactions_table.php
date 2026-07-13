<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menyimpan nilai nominal rupiah potongan compliment
            $table->integer('compliment_amount')->default(0)->after('refunded_amount');
            // Menyimpan alasan dikeluarkannya compliment
            $table->string('compliment_notes', 255)->nullable()->after('compliment_amount');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['compliment_amount', 'compliment_notes']);
        });
    }
};
