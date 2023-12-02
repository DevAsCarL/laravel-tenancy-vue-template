<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class IdentityDocumentType extends TenantModel
{
    public const DNI = 2;

    protected $fillable =  ['short', 'active', 'description'];
}
