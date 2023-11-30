<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Province extends TenantModel
{
    protected $fillable = [
        'description',
        'department_id',
        'status_id'
    ];

    static function idByDescription($description)
    {
        $province = Province::where('description', $description)->first();
        if ($province) {
            return $province->id;
        }
        return '1501';
    }
}