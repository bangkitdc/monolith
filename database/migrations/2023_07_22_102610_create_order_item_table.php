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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_history_id'); // Foreign key for the order_histories table
            $table->string('nama');
            $table->integer('quantity');
            $table->integer('harga');
            
            $table->timestamps();

            // Define foreign key relationship with order_histories table
            $table->foreign('order_history_id')->references('id')->on('order_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
