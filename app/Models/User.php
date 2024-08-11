<?php

namespace App\Models;

use App\Traits\MustVerifyMobile;
use App\Interfaces\MustVerifyMobile as IMustVerifyMobile;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Tenant;

class User extends \TCG\Voyager\Models\User implements IMustVerifyMobile
{
    use HasApiTokens, HasFactory, Notifiable;
    use MustVerifyMobile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'mobile_verify_code',
        'mobile_attempts_left',
        'mobile_last_attempt_date',
        'mobile_verify_code_sent_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'mobile_verify_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'number_verified_at' => 'datetime',
        'mobile_verify_code_sent_at' => 'datetime',
        'mobile_last_attempt_date' => 'datetime'
    ];
    
    /**
     * Get the children for the user.
     */
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * Get the parent for the user.
     */
    public function parent()
    {
        return $this->hasOne(User::class, 'id', 'parent_id');
    }


    public function routeNotificationForVonage($notification)
    {
        return $this->mobile_number;
    }
}
