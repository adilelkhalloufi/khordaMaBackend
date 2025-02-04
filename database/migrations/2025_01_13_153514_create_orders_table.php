<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products');
            $table->integer('quantity')->default(0);
            $table->decimal('price')->default(0);
            $table->text('note')->nullable();
            $table->string('address')->nullable();
            $table->integer('payment')
                ->nullable()
                ->comment('1:cash;2:credit card;3:paypal;4:other');
            $table->integer('status')
                ->default(1)
                ->comment('1:active;2:inactive;3:pending;4:deleted');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
