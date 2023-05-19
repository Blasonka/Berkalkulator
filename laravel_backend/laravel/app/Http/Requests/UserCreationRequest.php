<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:50',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|alpha_dash|max:255|confirmed',
            'password_confirmation' => 'required|string|alpha_dash|max:255'
        ];
    }
}
