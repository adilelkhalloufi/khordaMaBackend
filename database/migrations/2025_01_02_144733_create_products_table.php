<?php

use App\Models\Categorie;
use App\Models\Unite;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->foreignId('categorie_id')
                ->nullable()
                ->constrained(Categorie::TABLE_NAME);
            $table->foreignId('unite_id')
                ->nullable()
                ->constrained(Unite::TABLE_NAME);
            $table->integer('statue')->default(1);
            $table->string('conditions_document')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
