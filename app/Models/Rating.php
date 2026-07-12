<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'delivery_id',
        'giver_id',
        'receiver_id',
        'rating',
        'comment',
    ];


    // Delivery relationship
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }


    // Person who gives rating
    public function giver()
    {
        return $this->belongsTo(User::class, 'giver_id');
    }


    // Person who receives rating
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
