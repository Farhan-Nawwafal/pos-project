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
        Schema::table('transactions', function (Blueprint $blueprint) {
            $blueprint->string('bank_name')->nullable()->after('payment_method');
            $blueprint->string('account_name')->nullable()->after('bank_name');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['bank_name', 'account_name']);
        });
    }
};
