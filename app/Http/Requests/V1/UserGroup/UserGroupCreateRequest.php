<?php

namespace App\Http\Requests\V1\UserGroup;

use Illuminate\Foundation\Http\FormRequest;

class UserGroupCreateRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
        ];
    }
    public function messages():array {
        return [
            'name.required' => 'Bạn phải nhập tên nhóm thành viên',
            'description.required' => 'Bạn phải nhập mô tả cho nhóm thành viên'
        ];
    }
}
