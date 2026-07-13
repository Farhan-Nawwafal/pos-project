<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cabang_id');
            $table->unsignedBigInteger('started_by_user_id');
            $table->unsignedBigInteger('ended_by_user_id')->nullable();

            $table->decimal('starting_cash', 15, 2)->default(0.00);

            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();

            $table->enum('status', ['open', 'closed'])->default('open');

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
