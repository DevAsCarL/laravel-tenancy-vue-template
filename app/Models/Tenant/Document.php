<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Document extends TenantModel
{
    protected $fillable = [
        'documentable_id',
        'documentable_type',
        'pos_id'
    ];
    public function documentable()
    {
        return $this->morphTo();
    }
}
