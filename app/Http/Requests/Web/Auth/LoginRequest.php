<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\Web\BaseRequest;

//use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'loginid' => 'required|min:6',
            'password' => 'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'loginid.required' => 'Login Id cannot be empty',
            'loginid.min' => 'Login Id should be atleast 6 character',
            'password.required' => 'Password cannot be empty',
            'password.min' => 'Password should be atleast 6 character'
        ];
    }
}
