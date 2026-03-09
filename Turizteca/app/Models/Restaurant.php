<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Restaurant extends Model
{
    use HasFactory;


    public const CUISINES = [
        'mexican',
        'seafood',
        'italian',
        'bbq',
        'steakhouse',
        'vegan',
        'vegetarian',
        'asian',
        'japanese',
        'chinese',
        'thai',
        'indian',
        'mediterranean',
        'fast_food',
        'cafe',
        'bakery',
        'tacos',
        'pizza',
        'burgers',
        'bar',
        'fusion',
        'local'
    ];

    public const OPENING_TYPES = [
        'all_day',
        'breakfast_lunch',
        'lunch_dinner',
        'dinner_only',
        'weekdays_only',
        'weekends_only',
        'custom'
    ];

    protected $fillable = [
        'name',
        'description',
        'cuisine_type',
        'average_price',
        'location_lat',
        'location_lng',
        'opening_hours_type',
        'opens_at',
        'closes_at',
    ];

    protected $casts = [
        'average_price' => 'integer',

        'opens_at' => 'datetime:H:i:s',
        'closes_at' => 'datetime:H:i:s',
    ];


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }
}
