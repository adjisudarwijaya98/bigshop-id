<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1000', 'max:99999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:product_categories,id'],
            // Gambar tidak harus diisi (nullable), tapi jika diisi, harus format gambar
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
