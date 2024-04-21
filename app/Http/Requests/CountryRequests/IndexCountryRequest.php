<?php

namespace App\Http\Requests\CountryRequests;

use Illuminate\Foundation\Http\FormRequest;

class IndexCountryRequest extends FormRequest
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
            'code' => 'string|min:1|max:2',
            'continent' => 'string|min:1',
            'withCities' => 'boolean',
        ];
    }
}
