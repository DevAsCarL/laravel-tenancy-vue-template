<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Country extends TenantModel
{
    protected $fillable = [
        'short',
        'description',
        'status_id'
    ];
}
