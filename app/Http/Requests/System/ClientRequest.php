<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->input('id');


        $rules = [
            'email' => [
                'required',
                'email',
            ],
            'number' => [
                'required',
                Rule::unique('system.clients')->ignore($id),
            ],
            'name' => [
                'required',
                Rule::unique('system.clients')->ignore($id)
            ],
            'subdomain' => [
                'required'
            ],
            'plan_id' => [
                'required',
            ],
            'plan_start_date' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];

        if ($id == null) {
            $rules['password'] = ['required'];
        }

        return $rules;
    }
}
