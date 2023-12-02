<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Status extends TenantModel
{
    public const INACTIVE = 1;
    public const ACTIVE = 2;

    protected $table = 'status';
    protected $fillable = [
        'type',
    ];
}
