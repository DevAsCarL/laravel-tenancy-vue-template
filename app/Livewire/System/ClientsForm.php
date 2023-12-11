<?php

namespace App\Livewire\System;

use App\Models\System\Plan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class ClientsForm extends Component
{
    public object $form;

    public function __construct()
    {
        $this->form = (object)[
            'number' => '',
            'name' => '',
            'subdomain' => '',
            'identity_document_type_id' => '6',
            'email' => 'consulta@disoft.pe',
            'password' => 'dsjoe280811$',
            'plans' => Plan::pluck('name', 'id')->toArray(),
            'plan_id' => '',
            'plan_start_date' => Carbon::now()->toDateString(),
            'amount' => '',
        ];
    }

    public function render()
    {
        return view('livewire.system.clients-form');
    }
}
