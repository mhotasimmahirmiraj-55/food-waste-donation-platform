<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodDonation extends Model
{
    protected $fillable = [
    'donor_id',
    'food_category_id',
    'title',
    'description',
    'quantity',
    'expiry_time',
    'pickup_address',
    'latitude',
    'longitude',
    'pickup_date',
    'pickup_time',
    'status',
    'food_image',
];


    // Donor relationship
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
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
