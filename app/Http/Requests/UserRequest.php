<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'. Auth::id(),
            'email' => 'required|email|unique:users,email,'. Auth::id(),
            'introduction' => 'max:80'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => __('users.Username is already occupied, please fill it in again'),
            'name.regex' => __('users.Usernames only support English, numbers, dashes, and underscores'),
            'name.between' => __('users.Username must be between 3 and 25 characters'),
            'name.required' => __('users.Username cannot be empty'),
            'email.unique' => __("users.Email is already occupied")
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email address'
        ];
    }
}
