<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Printer extends TenantModel
{
    protected $with = ['establishment'];
    protected $fillable = [
        'establishment_id',
        'name',
        'ip',
        'active',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
