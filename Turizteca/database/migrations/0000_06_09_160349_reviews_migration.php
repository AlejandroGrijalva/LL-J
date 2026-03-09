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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('restaurant_id')
                  ->references('id')
                  ->on('restaurants')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->tinyInteger('rating'); // validate 1..5 in app/model
            $table->string('comment', 2000)->nullable();
            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('user_id');
            $table->index('rating');

            // Optional: one review per user per restaurant
            // $table->unique(['restaurant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};