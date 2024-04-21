<?php

namespace App\Http\Requests\StoreRequests;

use Illuminate\Foundation\Http\FormRequest;

class IndexStoreRequest extends FormRequest
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
            'name' => 'string|min:1',
            'city' => 'string|min:1',
            'address' => 'string|min:1',
            'foundedDate' => 'date',
            'openingTime' => 'date_format:H:i:s',
            'closingTime' => 'date_format:H:i:s',
            'withCity' => 'boolean',
        ];
    }
}
