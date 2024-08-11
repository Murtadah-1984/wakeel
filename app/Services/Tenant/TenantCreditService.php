<?php


namespace App\Services\Tenant;

use App\Models\Tenant;
use App\Models\CreditTransaction;
use Carbon\Carbon;

class TenantCreditService
{
    protected $tenant;
    protected $subscription;
    protected $credit_transaction;

    public function __construct(Tenant $tenant, CreditTransaction $credit_transaction)
    {
        $this->tenant = $tenant;
        $this->credit_transaction = $credit_transaction;
    }
    

    public function addCredit(Tenant $tenant,float $amount)
    {
        $time=Carbon::now();
        $this->tenant->credit_balance += $amount;
        $this->tenant->save();
        
        $this->credit_transaction = new CreditTransaction();
        $this->credit_transaction->tenant_id=$this->tenant->id;
        $this->credit_transaction->amount=$amount;
        $this->credit_transaction->transaction_type="add";
        $this->credit_transaction->description="Ammount of .$amount. is added successfuly to your credit on .$time";
        $this->credit_transaction->save();
        
    }

    public function deductCredit(float $amount)
    {
        if ($this->tenant->credit_balance >= $amount) {
            $this->tenant->credit_balance -= $amount;
            $this->tenant->save();
            
            $time=Carbon::now();
            $this->credit_transaction = new CreditTransaction();
            $this->credit_transaction->tenant_id=$this->tenant->id;
            $this->credit_transaction->amount=$amount;
            $this->credit_transaction->transaction_type="deduct";
            $this->credit_transaction->description="Ammount of .$amount. is deducted from your credit on .$time";
            $this->credit_transaction->save();
        } else {
            throw new \Exception('Insufficient credit balance');
        }
    }
    
    public function cancelPayAsYouGo()
    {
        $this->tenant->pay_as_you_go=0;
        $this->tenant->save();
    }
    
}
