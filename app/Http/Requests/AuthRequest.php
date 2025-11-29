<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->routeIs('auth')) {
            return [
                'email'    => 'required|string|email',
                'password' => 'required|string|min:8'
            ];
        }

        $rules = [
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8'
        ];

        if (Auth::check() && Auth::user()->isAdmin()) {
            $rules['role'] = 'required|in:admin,user';
        }

        return $rules;
    }
}