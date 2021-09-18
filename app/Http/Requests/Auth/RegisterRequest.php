<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;


class RegisterRequest extends FormRequest
{
    use SanitizesInput;
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'unique:users,username', 'alpha_dash', 'max:10'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'max:15', ' confirmed']
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Name is required!',
                'max' => 'Name cannot more than :max characters',
            ],

            'username' => [
                'required' => 'Username is required!',
                'max' => 'Username cannot more than :max characters',

            ],

            'email' => [
                'required' => 'Email is required!'
            ],

            'password' => [
                'required' => 'Password is required!',
                'max' => 'Password cannot more than :max characters',
                'confirmed' => 'Password doesn`t match'
            ]
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape|capitalize',
            'username' => 'trim|escape|lowercase',
            'email' => 'trim|lowercase',
        ];
    }
}
