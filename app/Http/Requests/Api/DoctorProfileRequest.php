<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DoctorProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Simple authorization: the user must be authenticated
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Determine the ID of the user creating/updating the profile
        $userId = $this->user()->id;
        
        // Define validation rules
        $rules = [
            'date_of_birth' => ['nullable', 'date'],
            'specialization' => ['required', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'hospital_id' => ['nullable', 'exists:hospital_profiles,id'],
        ];

        // Ensure a user can only have one profile (unique user_id check)
        if ($this->isMethod('POST')) {
             // For creation, check if a profile already exists for the current user
             $rules['user_id'] = [
                'sometimes',
                'unique:doctor_profiles,user_id', 
                'in:' . $userId
            ];
        }

        return $rules;
    }
    
    /**
     * Prepare the data for validation.
     * Automatically injects the authenticated user's ID.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}