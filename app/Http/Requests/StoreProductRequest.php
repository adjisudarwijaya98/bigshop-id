<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Izinkan hanya user yang sudah login untuk membuat produk
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1000', 'max:99999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:product_categories,id'], // Pastikan category_id ada di tabel product_categories
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Maksimum 2MB dan harus format gambar
        ];
    }
}
