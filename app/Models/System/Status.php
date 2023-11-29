<?php

namespace App\Models\System;

use Hyn\Tenancy\Abstracts\SystemModel;

class Status extends SystemModel
{
    public const INACTIVE = 1;
    public const ACTIVE = 2;

    protected $table = 'status';
    protected $fillable = [
        'type',
    ];
}
