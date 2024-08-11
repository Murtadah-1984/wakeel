<?php

namespace App\Services\Tenant;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TenantRegistrationService
{
    public function register(array $data)
    {
        // Create the User
         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile_number' => $data['mobile_number'],
        ]);

        // Attach role to the user
        $user->setRole('tenant');

        // Create the Tenant
        $tenant = Tenant::create([
            'name' => $data['name'],
            'user_id' => $user->id,
            'domain' => $data['domain'],
            'pay_as_you_go' => 1,
            'is_active' => 1,
            'credit_balance' => 50.00, 
        ]);

        return $user;
    }
}
