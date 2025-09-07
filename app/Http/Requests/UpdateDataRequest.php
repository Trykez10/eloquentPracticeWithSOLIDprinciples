<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataRequest extends FormRequest
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
            "firstname" => ["sometimes", "nullable", "string", "max:255"],
            "middlename" => ["sometimes", "nullable", "max:255"],
            "lastname" => ["sometimes", "nullable", "string", "max:255"],
            "age" => ["sometimes", "nullable", "integer"],
            "email" => ["sometimes", "nullable", "email"],
            "password" => ["sometimes", "nullable", "string"]
        ];
    }
}
