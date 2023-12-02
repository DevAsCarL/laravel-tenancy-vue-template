<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class PosStatus extends TenantModel
{
    protected $fillable = [
        'description',
    ];

    public function pos()
    {
        return $this->hasMany(Pos::class);
    }

}