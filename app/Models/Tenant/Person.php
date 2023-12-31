<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends TenantModel
{
    public const CUSTOMERS = 'customers';
    public const SUPPLIERS = 'suppliers';
    public const EMPLOYES = 'employes';

    protected $with = ['identity_document_type', 'country', 'department', 'province', 'district'];
    protected $fillable = [
        'identity_document_type_id',
        'number',
        'name',
        'trade_name',
        'country_id',
        'department_id',
        'province_id',
        'district_id',
        'address',
        'email',
        'credit_pen',
        'credit_usd',
        'telephone',
        'establishmen_id',
        'status_id'
    ];

    public function identity_document_type()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'identity_document_type_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function scopeWhereType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getAddressFullAttribute()
    {
        $address = trim($this->address);
        $address = ($address === '-' || $address === '') ? '' : $address . ' ,';
        if ($address === '') {
            return '';
        }

        if (!is_null($this->department_id) && !is_null($this->province_id) && !is_null($this->district_id)) {
            return "{$address} {$this->department->description} - {$this->province->description} - {$this->district->description}";
        } else {
            return $address;
        }
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
