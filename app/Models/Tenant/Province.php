<?php

namespace App\Models\Tenant\Catalogs;

use Hyn\Tenancy\Abstracts\TenantModel;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Province extends TenantModel
{
    public $timestamps = false;

    static function idByDescription($description)
    {
        $province = Province::where('description', $description)->first();
        if ($province) {
            return $province->id;
        }
        return '1501';
    }
}