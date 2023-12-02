<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class SuppliesUncountable extends TenantModel
{
    protected $fillable = [
        'description',
        'status',
        'type'
    ];

    public const FOOD = 'FOOD';
    public const JUICES = 'JUICES';
    public const SODA = 'SODA';

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
