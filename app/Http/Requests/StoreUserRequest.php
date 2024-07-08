<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'gt:0',
            'password' => 'required|string',
            're_password' => 'required|string|same:password',
        ];
    }
    public function messages(): array{
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng, ví dụ abc@xyz.com',
            'email.unique' => 'Email đã tồn tại, chọn email khác',
            'email.string' => 'Email phải là dạng kí tự',
            'email.max' => 'Email tối đa 191 kí tự',
            'name.required' => 'Vui lòng nhập họ tên',
            'name.string' => 'Họ tên phải là dạng kí tự',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            're_password.required' => 'Vui lòng nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu không khớp'
        ];
    }
}
