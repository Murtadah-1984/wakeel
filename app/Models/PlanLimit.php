<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class PlanLimit extends Model
{
    protected $fillable = ['plan_id', 'limit_name', 'limit_value'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
