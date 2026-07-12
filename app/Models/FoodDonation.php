<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodDonation extends Model
{
    protected $fillable = [
        'user_id',
        'food_category_id',
        'title',
        'description',
        'quantity',
        'pickup_location',
        'expiry_date',
        'status',
    ];


    // Donor relationship
    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Category relationship
    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }


    // Claims relationship
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }


    // Bookmark relationship
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
