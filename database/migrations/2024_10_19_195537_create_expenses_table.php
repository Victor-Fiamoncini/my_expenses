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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->nullable(false);
            $table->float('value')->nullable(false);
            $table->date('payment_date')->nullable(false);
            $table->enum('type', ['IN_INSTALLMENTS', 'SINGLE'])
                ->nullable(false)
                ->default('SINGLE');
            $table->integer('number_of_installments')
                ->nullable(false)
                ->min(0);
            $table->boolean('paid')->default(false);
            $table->timestamps();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
