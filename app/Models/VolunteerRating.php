<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerRating extends Model
{
    protected $fillable = [
        'delivery_id',
        'giver_id',
        'volunteer_id',
        'rating',
        'review',
    ];

    // Delivery being rated
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    // Receiver who gives the rating
    public function giver()
    {
        return $this->belongsTo(User::class, 'giver_id');
    }

    // Volunteer who receives the rating
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}