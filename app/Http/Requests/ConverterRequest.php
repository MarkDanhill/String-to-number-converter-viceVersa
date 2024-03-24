<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConverterRequest extends FormRequest
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
            'string' => 'nullable|regex:/^[a-zA-Z\s]+$/',
            'number' => 'nullable|regex:/^\d+$/'
        ];
    }

    public function messages()
    {
        return[
            'string.regex' =>'The Text should only contain valid numbers in text',
            'number.regex' =>'The Digits should only contain numbers '
        ];
    }
}
