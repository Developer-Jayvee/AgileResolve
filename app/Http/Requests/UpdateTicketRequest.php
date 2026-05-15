<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class UpdateTicketRequest extends FormRequest
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
            'title' => ['unique:tickets,title'],
            'content' ,
            'deadline' => ['date'],
            'projects_id' => ['exists:projects,id'],
            'status' => [Rule::enum(TicketStatus::class)]
        ];
    }
    #[Override]
    protected function failedValidation(Validator $validator)
    {
        $this->failedValidationResponse($validator);
    }
}
