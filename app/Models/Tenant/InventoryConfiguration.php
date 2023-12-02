<?php

namespace Modules\Inventory\Models;

use Hyn\Tenancy\Abstracts\TenantModel;

class InventoryConfiguration extends TenantModel
{
    protected $fillable = [
        'stock_control',
        'active_supplies'
    ];
}
