<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class District extends TenantModel
{
    protected $fillable = [
        'description',
        'province_id',
        'status_id'
    ];

    static function idByDescription($description, $province_id)
    {
        $district = District::where('description', $description)
                            ->where('province_id', $province_id)
                            ->first();
        if ($district) {
            return $district->id;
        }
        return '150101';
    }
}