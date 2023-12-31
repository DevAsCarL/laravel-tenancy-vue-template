<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token,
            'plan_id' => $this->plan_id,
            'plan_start_date' => ($this->plan_start_date) ? $this->plan_start_date->format("Y-m-d") : null,
            'amount' => $this->amount,
            'hostname' => $this->hostname->fqdn
        ];
    }
}
