<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email, '.$this->id. '|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'gt:0',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng, ví dụ abc@xyz.com',
            'email.string' => 'Email phải là dạng kí tự',
            'email.max' => 'Email tối đa 191 kí tự',
            'name.required' => 'Vui lòng nhập họ tên',
            'name.string' => 'Họ tên phải là dạng kí tự',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
        ];
    }
}
