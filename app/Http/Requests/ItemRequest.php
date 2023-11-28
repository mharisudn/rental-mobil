<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'brand_id' => 'required|integer|exists:brands,id',
            'type_id' => 'required|integer|exists:types,id',
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'features' => 'required|string',
            'price' => 'required|numeric',
            'star' => 'nullable|numeric',
            'review' => 'nullable|numeric'
        ];
    }
}
