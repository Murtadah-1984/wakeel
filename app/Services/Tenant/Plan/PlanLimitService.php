<?php

namespace App\Services\Tenant\Plan;

use App\Models\Tenant;
use App\Models\Subscription;
use App\Models\Plan;
use Carbon\Carbon;

class PlanLimitService
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    protected function checkWorkflowLimit(Plan $plan)
    {
        $workflowLimit = $plan->limits()->where('limit_name', 'workflows')->first();
        if (!$workflowLimit) {
            throw new \Exception('Workflow limit not defined for this plan.');
        }

        $usedWorkflows = $this->tenant->getUsedWorkflowsForCurrentPeriod();

        if ($usedWorkflows >= $workflowLimit->limit_value) {
            throw new \Exception('You have reached your workflow limit for this period.');
        }

        // Allow workflow processing (log workflow usage, etc.)
    }
}
