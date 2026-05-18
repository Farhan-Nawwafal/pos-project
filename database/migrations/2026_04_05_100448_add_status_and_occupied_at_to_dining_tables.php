<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dining_tables', function (Blueprint $table) {
            $table->string('status')->default('available')->after('table_number');
            $table->timestamp('occupied_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('dining_tables', function (Blueprint $table) {
            // Jangan lupa hapus kolomnya kalau di-rollback
            $table->dropColumn(['status', 'occupied_at']);
        });
    }
};
