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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('display')->default(0);
            $table->integer('parent_id')->index()->nullable();
            $table->foreignId('family_id')
                ->nullable()
                ->constrained('families');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
