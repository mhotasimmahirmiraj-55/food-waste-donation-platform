<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodDonationItem extends Model
{
    protected $fillable = [
        'food_donation_id',
        'food_category_id',
        'item_name',
        'quantity',
        'unit',
    ];

    public function foodDonation(): BelongsTo
    {
        return $this->belongsTo(FoodDonation::class);
    }

    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class);
    }
}