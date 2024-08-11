<div>
    @if ($currentStep == 1)
        <!-- Step 1: User Registration -->
        <h2>Register</h2>
        <div>
            <input type="text" wire:model="name" placeholder="Name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="email" wire:model="email" placeholder="Email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="password" wire:model="password" placeholder="Password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button wire:click="nextStep">Next</button>
    @endif

    @if ($currentStep == 2)
        <!-- Step 2: Plan Selection -->
        <h2>Select a Plan</h2>
        <div>
            @foreach($plans as $plan)
                <label>
                    <input type="radio" wire:model="plan_id" value="{{ $plan->id }}">
                    {{ $plan->name }} - ${{ $plan->price }} / {{ $plan->type }}
                </label><br>
            @endforeach
            @error('plan_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button wire:click="previousStep">Back</button>
        <button wire:click="nextStep">Next</button>
    @endif

    @if ($currentStep == 3)
        <!-- Step 3: Payment Details -->
        <h2>Payment Details</h2>
        <div>
            <input type="text" wire:model="card_number" placeholder="Card Number">
            @error('card_number') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="text" wire:model="expiry_date" placeholder="Expiry Date (MM/YY)">
            @error('expiry_date') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <input type="text" wire:model="cvv" placeholder="CVV">
            @error('cvv') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button wire:click="previousStep">Back</button>
        <button wire:click="submitForm">Submit</button>
    @endif
</div>
