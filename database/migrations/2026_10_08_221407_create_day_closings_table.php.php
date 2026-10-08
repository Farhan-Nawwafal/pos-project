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
        Schema::create('day_closings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')->constrained('cabangs')->cascadeOnDelete();
            $table->foreignId('closed_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->date('closing_date');
            $table->timestamp('closed_at');
            $table->decimal('total_net_sales', 15, 2)->default(0);
            $table->integer('total_bills')->default(0);
            $table->timestamps();

            // Satu cabang hanya boleh end day 1x per hari
            $table->unique(['cabang_id', 'closing_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('day_closings');
    }
};
