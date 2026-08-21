<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_user_id',
        'food_donation_id',
        'reason',
        'status',
    ];

    // User who submitted the report
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // User being reported
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    // Donation being reported
    public function foodDonation()
    {
        return $this->belongsTo(FoodDonation::class);
    }
}