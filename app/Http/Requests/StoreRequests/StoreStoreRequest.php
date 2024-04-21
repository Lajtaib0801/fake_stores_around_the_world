<?php

namespace App\Http\Requests\StoreRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'city' => 'required|integer|exists:cities,id',
            'address' => 'required|string|min:5|max:255|unique:stores,address',
            'foundedDate' => 'nullable|date',
            'openingTime' => 'nullable|date_format:H:i:s',
            'closingTime' => 'nullable|date_format:H:i:s',
            'picture' => 'nullable|string|min:1|max:255|image',
        ];
    }
}
