<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'position_id' => 'required|integer|exists:positions,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
            'linkedin_url' => 'nullable|string|url',
            'cv' => 'nullable|file|mimes:pdf|max:20000'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status_id' => Status::where('name', 'Initial')->first()->id
        ]);
    }
}
