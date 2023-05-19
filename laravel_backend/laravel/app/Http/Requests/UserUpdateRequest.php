<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|min:1|max:50',
            'email' => 'string|email|max:100',
            'password' => 'string|alpha_dash|max:255|confirmed',
            'password_confirmation' => 'string|alpha_dash|max:255'
        ];
    }
}
