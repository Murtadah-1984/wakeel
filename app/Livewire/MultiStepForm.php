<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\Tenant\TenantSubscriptionService;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $name, $email, $password, $password_confirmation;
    public $plan_id, $plan;
    public $card_number, $expiry_date, $cvv;

    public function render()
    {
        return view('livewire.multi-step-form', [
            'plans' => Plan::active()->get(),
        ]);
    }

    // Go to the next step
    public function nextStep()
    {
        $this->validateCurrentStep();

        $this->currentStep++;
    }

    // Go to the previous step
    public function previousStep()
    {
        $this->currentStep--;
    }

    // Validate and process the current step
    public function validateCurrentStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'plan_id' => 'required|exists:plans,id',
            ]);
            $this->plan = Plan::find($this->plan_id);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'card_number' => 'required|numeric',
                'expiry_date' => 'required|date_format:m/y',
                'cvv' => 'required|numeric|digits:3',
            ]);
        }
    }

    // Submit the form
    public function submitForm()
    {
        $this->validateCurrentStep();

        // Create the user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Subscribe the user to the selected plan
        $tenant = $user->tenant()->create(); // Assuming Tenant is related to User
        $subscriptionService = new TenantSubscriptionService($tenant, new \App\Models\Subscription);
        $subscriptionService->subscribe($this->plan->tier, $this->plan->type);

        // Process the payment (this is a placeholder)
        // You would integrate with a payment gateway here

        return redirect()->route('dashboard'); // Redirect to the dashboard or another page
    }
}
