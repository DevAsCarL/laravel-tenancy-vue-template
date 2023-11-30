<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Department extends TenantModel
{
    protected $fillable = [
        'description',
        'status_id',
    ];

    static function idByDescription($description)
    {
        $department = Department::where('description', $description)->first();
        if ($department) {
            return $department->id;
        }
        return '15';
    }
}
