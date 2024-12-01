<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expense_installments', function (Blueprint $table) {
            $table->id();
            $table->float('value')->nullable(false);
            $table->boolean('paid')->default(false);
            $table->timestamps();
            $table->foreignId('expense_id')
                ->constrained('expenses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_installments');
    }
};