<?php


namespace App\Services\Tenant;

use App\Models\Tenant;
use App\Models\CreditTransaction;
use Carbon\Carbon;

class TenantDomainService
{
    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }
    

    public function setDomain()
    {
         return $this->user->tenant->domain;
    }
}
