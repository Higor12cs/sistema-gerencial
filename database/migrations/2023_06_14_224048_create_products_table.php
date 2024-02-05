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
            $table->foreignId('product_brand_id')->nullable()->constrained();
            $table->foreignId('product_category_id')->nullable()->constrained();
            $table->foreignId('product_season_id')->nullable()->constrained();
            $table->foreignId('product_size_id')->nullable()->constrained();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->bigInteger('cost')->default(0);
            $table->bigInteger('price')->default(0);
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->references('id')->on('users')->constrained();
            $table->timestamps();
            $table->softDeletes();
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
