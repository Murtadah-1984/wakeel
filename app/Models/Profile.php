<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'settings'];

    protected $casts = [
        'settings' => 'array', // Cast 'settings' to an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
