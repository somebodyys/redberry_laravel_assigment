<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'position_id' => 'sometimes|integer|exists:positions,id',
            'status_id' => 'sometimes|integer|exists:statuses,id',
            'min_salary' => 'sometimes|numeric',
            'max_salary' => 'sometimes|numeric',
            'linkedin_url' => 'sometimes|url',
            'cv' => 'sometimes|file|mimes:pdf|max:20000',
            'comment' => 'required_with:status_id'
        ];
    }
}
