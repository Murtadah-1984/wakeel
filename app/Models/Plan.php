<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use App\Models\PlanLimit;

class Plan extends Model
{
    protected $fillable = ['name', 'type', 'tier', 'price', 'is_active'];
    
    public function limits()
    {
        return $this->hasMany(PlanLimit::class);
    }
    
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Scope a query to only include active plans.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
