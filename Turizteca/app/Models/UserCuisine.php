<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCuisine extends Model
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

    protected $fillable = [
        'user_id',
        'cuisine',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
