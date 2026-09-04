<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FoodCategory;
use App\Models\FoodDonationItem;
use App\Models\Report;

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


    // Category relationship / accessor via donation items
    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }

    public function getCategoryAttribute()
    {
        return $this->items->first()?->foodCategory;
    }

// Donation items relationship
public function items()
{
    return $this->hasMany(FoodDonationItem::class, 'food_donation_id');
}

// Donation reports relationship
public function reports()
{
    return $this->hasMany(Report::class, 'food_donation_id');
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

    /**
     * Get all raw image paths as an array.
     */
    public function getImagesAttribute(): array
    {
        if (!$this->food_image) {
            return [];
        }

        $raw = trim($this->food_image);

        // JSON array format: ["path1", "path2"]
        if (str_starts_with($raw, '[') && str_ends_with($raw, ']')) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                return array_values(array_filter($decoded));
            }
        }

        // Comma-separated format
        if (str_contains($raw, ',')) {
            return array_values(array_filter(array_map('trim', explode(',', $raw))));
        }

        return [$raw];
    }

    /**
     * Get all image full URLs as an array.
     */
    public function getImageUrlsAttribute(): array
    {
        $urls = [];
        foreach ($this->images as $img) {
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                $urls[] = $img;
            } elseif (str_starts_with($img, 'storage/')) {
                $urls[] = asset($img);
            } else {
                $urls[] = asset('storage/' . $img);
            }
        }
        return $urls;
    }

    /**
     * Get primary image URL (first image) with fallback.
     */
    public function getImageUrlAttribute(): ?string
    {
        $urls = $this->image_urls;
        return $urls[0] ?? null;
    }
}
