<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Establishment;
use Hyn\Tenancy\Abstracts\TenantModel;

class CashRegister extends TenantModel
{
    protected $with = ['establishment'];

    protected $fillable = [
        'establishment_id',
        'name',
        'status',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    static function idByDescription($description)
    {
        $caja = CashRegister::where('name', $description)->first();
        if ($caja) {
            return $caja->id;
        }
        return '1';
    }

    public function denomination_caja()
    {
        return $this->hasMany(DenominationCaja::class);
    }
}
