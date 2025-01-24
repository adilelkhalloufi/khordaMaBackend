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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('description')->nullable();
            $table->integer('status')
                ->default(1)
                ->comment('1:active;2:inactive;3:pending;4:deleted');

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
