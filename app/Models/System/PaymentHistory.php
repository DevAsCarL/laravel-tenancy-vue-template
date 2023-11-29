<?php

namespace App\Models\System;

use Hyn\Tenancy\Abstracts\SystemModel;

class PaymentHistory extends SystemModel   
{

    protected $table = "payment_history";

    protected $fillable = [
        'client_id',
        'plan_id',
        'amount',
        'date_payment'
    ];

    public $timestamps = false;
}
