<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;


class Subscription extends Model
{
    protected $fillable = ['tenant_id', 'plan_type', 'plan_tier', 'starts_at', 'expires_at','is_active'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isExpired()
    {
        return $this->expires_at ? $this->expires_at->isPast() : false;
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

