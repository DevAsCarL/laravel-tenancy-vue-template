<?php

namespace App\Models\System;

use Hyn\Tenancy\Abstracts\SystemModel;

class Plan extends SystemModel
{
    protected $fillable = [
        'name',
        'months',
        'locked',
    ];
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
