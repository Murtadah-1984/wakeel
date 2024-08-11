<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;


class CreditTransaction extends Model
{
    protected $fillable = ['tenant_id', 'amount', 'transaction_type', 'description'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
