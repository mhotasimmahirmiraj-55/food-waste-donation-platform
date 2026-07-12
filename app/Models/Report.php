<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];


    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
