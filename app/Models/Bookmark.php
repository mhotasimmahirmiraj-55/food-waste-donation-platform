<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'food_donation_id',
    ];


    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Food donation relationship
    public function foodDonation()
    {
        return $this->belongsTo(FoodDonation::class);
    }
}
