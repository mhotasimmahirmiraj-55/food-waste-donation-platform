<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryProof extends Model
{
    protected $fillable = [
        'delivery_id',
        'proof_image',
        'description',
    ];


    // Delivery relationship
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
