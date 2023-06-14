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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_color_id')->nullable()->constrained();
            $table->foreignId('product_size_id')->nullable()->constrained();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('name')->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('quantity')->default(0);
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
        Schema::dropIfExists('product_variants');
    }
};
