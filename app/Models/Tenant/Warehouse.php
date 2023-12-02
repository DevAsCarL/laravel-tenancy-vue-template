<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Warehouse extends TenantModel
{
    protected $with = ['establishment'];
    protected $fillable = [
        'establishment_id',
        'description',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
    public function inventory_kardex()
    {
        return $this->hasMany(InventoryKardex::class);
    }
}
