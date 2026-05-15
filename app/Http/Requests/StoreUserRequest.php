<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreUserRequest extends FormRequest
{
    use ResponseTrait;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required','unique:users'],
            'password' => ['required'],
            'email' => ['required','email','unique:users,email'],
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'middle_initial' => ['string'],
            'birthdate' => ['required','date'],
            'role_id' => ['required','exists:roles,id']

        ];
    }

    #[Override]
    protected function failedValidation(Validator $validator)
    {
        $this->failedValidationResponse($validator);
    }
}
