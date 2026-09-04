<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'food_donation_id',
        'receiver_id',
        'status',
        'cancellation_reason',
    ];


    // Donation relationship
    public function foodDonation()
    {
        return $this->belongsTo(FoodDonation::class);
    }


    // Receiver relationship
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    // Delivery relationship
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
}
