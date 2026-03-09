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
        // Centralized cuisine options for consistency
        $cuisines = [
            'mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian',
            'asian','japanese','chinese','thai','indian','mediterranean',
            'fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'
        ];

        Schema::create('user_cuisines', function (Blueprint $table) use ($cuisines) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('cuisine', $cuisines);
            $table->timestamps();

            $table->unique(['user_id', 'cuisine']); // prevent duplicates
            $table->index('cuisine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cuisines');
    }
};