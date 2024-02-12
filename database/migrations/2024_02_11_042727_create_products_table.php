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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedInteger('image_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price_purchase')->nullable();
            $table->decimal('price_sale')->nullable();
            $table->decimal('price_wholesale')->nullable();
            $table->string('term')->nullable();
            $table->string('shipping')->nullable();
            $table->string('warranty')->nullable();
            $table->boolean('check_percentage')->default(false);
            $table->BigInteger('percentage')->nullable();
            $table->timestamps();
            // Definir las relaciones
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('image_id')->references('id')->on('images');
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
