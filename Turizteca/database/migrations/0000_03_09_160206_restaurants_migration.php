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
        $cuisines = [
            'mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian',
            'asian','japanese','chinese','thai','indian','mediterranean',
            'fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'
        ];

        $openingTypes = [
            'all_day',        // simple: same open/close daily or 24h
            'breakfast_lunch',
            'lunch_dinner',
            'dinner_only',
            'weekdays_only',
            'weekends_only',
            'custom'          // handle logic in app if needed
        ];

        Schema::create('restaurants', function (Blueprint $table) use ($cuisines, $openingTypes) {
            $table->id();
            $table->string('name', 120);
            $table->text('description')->nullable();
            $table->enum('cuisine_type', $cuisines);
            $table->integer('average_price')->nullable(); // local currency units
            $table->decimal('location_lat', 9, 6);
            $table->decimal('location_lng', 9, 6);

            // Replaces JSON opening_hours
            $table->enum('opening_hours_type', $openingTypes)->default('all_day');
            $table->time('opens_at')->nullable();
            $table->time('closes_at')->nullable();

            $table->timestamps();

            // Helpful indexes
            $table->index('cuisine_type');
            $table->index(['location_lat', 'location_lng']);
            $table->index('opening_hours_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};