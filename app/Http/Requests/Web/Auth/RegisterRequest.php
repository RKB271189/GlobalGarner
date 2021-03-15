<?php

namespace App\Http\Requests\web\Auth;

use App\Http\Requests\Api\BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'loginid' => 'required|min:6|email|unique:users,loginid',
            'password' => 'required|min:6',
            'mobileno' => 'required|mobile|unique:users,mobileno',
        ];
    }
    public function messages()
    {
        return [
            'loginid.required' => 'Login Id cannot be empty',
            'loginid.min' => 'Login Id should be atleast 6 character',
            'password.required' => 'Password cannot be empty',
            'password.min' => 'Password should be atleast 6 character',
            'name.required' => 'Name cannot be empty',
            'name.min' => 'Invalid name provided',
            'mobileno' => 'Mobile Number cannot be empty',
            'mobileno.mobile' => 'Invalid Mobile Number provided'
        ];
    }
}
