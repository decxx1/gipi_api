<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'category_id' => 'required|exists:categories,id',
            'code' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'text',],
            'price_purchase' => ['nullable', 'numeric'],
            'price_sale' => ['nullable', 'numeric'],
            'price_wholesale' => ['nullable', 'numeric'],
            'term' => ['nullable', 'string', 'max:255'],
            'shipping' => ['nullable', 'string', 'max:255'],
            'warranty' => ['nullable', 'string', 'max:255'],
            'check_percentage' => ['nullable', 'boolean'],
            'percentage' => ['nullable', 'numeric', 'max:10'],
        ];
    }
}
