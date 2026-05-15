<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class StoreTicketRequest extends FormRequest
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
            'title' => ['required','unique:tickets,title'],
            'content' => ['required'],
            'deadline' => ['required','date'],
            'projects_id' => ['required','exists:projects,id'],
            'created_by' => ['required','exists:users,id'],
            'status' => [Rule::enum(TicketStatus::class)]
        ];
    }
    /**
     * failedValidation
     *
     * @param  mixed $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
       $this->failedValidationResponse($validator);
    }
}
