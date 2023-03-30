<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            "name" => [
                "bail",
                'required',
                'string',
                'max:255'
            ],
            "email" => [
                "bail",
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            "password" => [
                "bail",
                "required",
                'string',
                'min:8',
                'confirmed'
            ],
            "company_id" => [
                "integer"
            ],
            "city" => [
                "string"
            ],
            "role" => [
                "integer",
                Rule::in(UserRoleEnum::getAllRoleName()),
            ]
        ];
    }
}
