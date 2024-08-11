<?php


namespace App\Services\Tenant;

use App\Models\Tenant;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;

class TenantSubscriptionService
{
    protected $tenant;
    protected $subscription;

    public function __construct(Tenant $tenant, Subscription $subscription)
    {
        $this->tenant = $tenant;
        $this->subscription = $subscription;
    }
    
    public function initializeSubscription()
    {
        $this->tenant->credit_balance = 50.00;
        $this->tenant->pay_as_you_go=1;
        $this->tenant->save();
    }
    
 

    public function subscribe(Plan $plan)
    {
        // Deactivate any previous active subscription for the tenant
        $this->deactivateCurrentSubscription();
        
        $this->tenant->plan()->associate($plan);
        $this->tenant->save();

        // Create a new subscription
        $this->subscription = new Subscription();
        $this->subscription->tenant_id = $this->tenant->id;
        $this->subscription->starts_at = Carbon::now();
        
        if ($plan->type === 'monthly') {
            $this->subscription->expires_at = Carbon::now()->addMonth();
        } elseif ($plan->type === 'yearly') {
            $this->subscription->expires_at = Carbon::now()->addYear();
        }
        
        $this->subscription->is_active = 1;
        $this->subscription->save();
    }


     public function resubscribe()
    {
        // Find the current active subscription
        $currentSubscription = $this->tenant->subscriptions()->where('is_active', 1)->first();

        if (!$currentSubscription) {
            throw new \Exception('No active subscription found to resubscribe.');
        }

        // Extend the expiration date based on the current plan
        if ($currentSubscription->plan_type === 'monthly') {
            $currentSubscription->expires_at = $currentSubscription->expires_at->addMonth();
        } elseif ($currentSubscription->plan_type === 'yearly') {
            $currentSubscription->expires_at = $currentSubscription->expires_at->addYear();
        }

        $currentSubscription->save();
    }


    public function isSubscriptionActive(): bool
    {
        return $this->tenant->subscription_expires_at && $this->tenant->subscription_expires_at->isFuture();
    }
    
    
    protected function deactivateCurrentSubscription()
    {
        // Find the current active subscription and deactivate it
        $currentSubscription = $this->tenant->subscriptions()->where('is_active', 1)->first();
        
        if ($currentSubscription) {
            $currentSubscription->is_active = 0;
            $currentSubscription->save();
        }
    }
    
    
}
