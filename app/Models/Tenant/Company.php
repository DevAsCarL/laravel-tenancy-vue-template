<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\SoftDeletes;
use Hyn\Tenancy\Abstracts\TenantModel;

class Company extends TenantModel
{
    use SoftDeletes;
    protected $with = ['identity_document_type'];
    protected $fillable = [
        'user_id',
        'identity_document_type_id',
        'number',
        'name',
        'trade_name',
        'subtitle',
        'soap_send_id',
        'soap_type_id',
        'soap_username',
        'soap_password',
        'sunat_username',
        'sunat_password',
        'soap_url',
        'gre_client_id',
        'gre_client_secret',
        'gre_access_token',
        'gre_expire_in',
        'certificate',
        'logo',
        'flag_menu',
    ];

    public function identity_document_type()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'identity_document_type_id');
    }

    public static function active()
    {
        return Company::first();
    }
}
