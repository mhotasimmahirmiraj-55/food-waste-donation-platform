<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'claim_id',
        'volunteer_id',
        'status',
        'accepted_at',
        'picked_up_at',
        'delivered_at',
    ];


    // Claim relationship
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }


    // Volunteer relationship
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }


    // Delivery proof relationship
    public function deliveryProof()
    {
        return $this->hasOne(DeliveryProof::class);
    }


    // Rating relationship
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}