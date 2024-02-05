<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:100'],
            'telphone' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'max:100', Rule::unique('users', 'email')],
            'role' => ['nullable', Rule::exists('roles', 'id')],
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique' => __('El email ya existe.'),
            'role.exists' => __('El rol no existe.'),
        ];
    }
}
