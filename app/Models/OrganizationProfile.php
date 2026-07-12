<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'user_id',
        'organization_name',
        'description',
        'address',
        'contact_number',
    ];


    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}