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
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quantity')->default(1);

            $table->foreignId('categorie_id')
                ->nullable()
                ->constrained('categories');

            $table->foreignId('unite_id')
                ->nullable()
                ->constrained('unites');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->integer('statue')->default(1);

            $table->boolean("auction")->default(false);
            $table->date("date_end_auction")->nullable();

            $table->boolean("conditions_document")->default(false);
            $table->boolean("conditions_document_price")->default(10);

            $table->boolean("show_company")->default(false);

            $table->integer('statue')->default(1);

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
