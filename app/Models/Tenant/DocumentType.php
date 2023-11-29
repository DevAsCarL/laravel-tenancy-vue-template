<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class DocumentType extends TenantModel
{
    public const INVOICE = '01';
    public const TICKET = '03';
    public const ANNULATION_SALE_NOTE = '06';
    public const CREDIT_NOTE = '07';
    public const SALE_NOTE = '100';
}
