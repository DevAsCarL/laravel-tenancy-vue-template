<?php

namespace App\Models\System;

use Hyn\Tenancy\Abstracts\SystemModel; 

class PlanDocument extends SystemModel
{ 

    protected $table = "plan_documents";
    
    protected $fillable = [
        'description', 
    ];

    public $timestamps = false;
}
