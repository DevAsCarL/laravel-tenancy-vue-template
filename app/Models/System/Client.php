<?php

namespace App\Models\System;

use Hyn\Tenancy\Abstracts\SystemModel;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Traits\UsesSystemConnection;

class Client extends SystemModel
{
    use UsesSystemConnection;

    protected $with = ['hostname', 'plan'];
    protected $fillable = [
        'hostname_id',
        'number',
        'name',
        'email',
        'token',
        'locked',
        'plan_id',
        'plan_start_date',
        'amount',
        'status'
    ];

    protected $casts = [
        'plan_start_date' => 'date'
    ];

    public function hostname()
    {
        return $this->belongsTo(Hostname::class)->with(['website']);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
