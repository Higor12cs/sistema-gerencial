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
        Schema::create('trial_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trial_id')->constrained();
            $table->foreignId('product_variant_id')->constrained();
            $table->string('transaction_type', 50);
            $table->dateTime('transaction_date');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('unit_price')->default(0);
            $table->bigInteger('total_price')->default(0);
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
        Schema::dropIfExists('trial_items');
    }
};
