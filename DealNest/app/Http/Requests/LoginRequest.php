<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Không được bỏ trống :attribute',
            'email' => 'Email không hợp lệ',
            'min' => ':attribute tối thiểu :size'
        ];
    }

    // public function attributes(): array
    // {
    //     return [
    //         'email' => 'Email',
    //         'password' => 'Mật khẩu',
    //     ];
    // }
}