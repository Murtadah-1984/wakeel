<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Cerdit;


class Tenant extends Model 
{
    protected $fillable = [
        'name',
        'user_id',
        'domain',
        'pay_as_you_go',
        'is_active',
        'credit_balance',
        'parent_id'
    ];

    protected $dates = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(Tenant::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Tenant::class, 'parent_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    
    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->where('is_active', true);
    }

    public function creditTransactions()
    {
        return $this->hasMany(Cerdit::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
