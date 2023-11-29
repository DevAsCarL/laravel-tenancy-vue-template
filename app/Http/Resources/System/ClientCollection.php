<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($row, $key) {
            return [
                'id' => $row->id,
                'hostname' => $row->hostname->fqdn,
                'name' => $row->name,
                'email' => $row->email,
                'token' => $row->token,
                'number' => $row->number,
                'plan' => ($row->plan) ? $row->plan->name : null,
                'plan_start_date' => ($row->plan_start_date) ? $row->plan_start_date->format('Y-m-d') : null,
                'amount' => $row->amount,
                'active' => $row->active == 1 ? true : false,
                'locked' => (bool) $row->locked,
                'count_doc' => $row->count_doc,
                'max_documents' => 99999, //(int) $row->plan->limit_documents,
                'count_user' => $row->count_user,
                'max_users' => 99999, //(int) $row->plan->limit_users,
                'created_at' => $row->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $row->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }
}
