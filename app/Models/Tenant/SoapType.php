<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class SoapType extends TenantModel
{
    protected $fillable = ['description'];
}
