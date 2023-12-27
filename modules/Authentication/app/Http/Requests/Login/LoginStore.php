<?php

namespace Modules\Authentication\app\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginStore extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:tenant.people'],
            'password' => ['required'],
            'remember' => ['boolean'],
            'redirect' => ['nullable', 'string'],
        ];
    }
}
