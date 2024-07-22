<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'menu' => 'array',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

