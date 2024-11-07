<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
        // allow the same email and website_url that the edited company had originally
        $employeeId = $this->route('employee');

        return [
            'first_name' => 'required|string|max:255|min:2',
            'last_name' => 'required|string|max:255|min:2',
            'company_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|string|email|unique:employees,email,' . $employeeId,
            'phone_number' => 'nullable|regex:/^\+?[0-9\s\-()]*$/',
        ];
    }
}
