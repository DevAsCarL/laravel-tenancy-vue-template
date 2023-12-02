<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class EstablishmentItem extends TenantModel

{
    public $timestamps = false;

    protected $fillable = [
        'establishment_id',
        'item_id',
        'quantity'
    ];

    public function establisment()
    {
        return $this->belongsTo(Establisment::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
