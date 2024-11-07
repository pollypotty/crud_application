<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
        $companyId = $this->route('company');

        return [
            'name' => 'required|string||min:2|max:255',
            'email' => 'nullable|string|email|max:255|unique:companies,email,' . $companyId,
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|dimensions:min_width=100,min_height=100|max:2048',
            'website_url' => 'nullable|string|max:255|url|unique:companies,website_url,' . $companyId,
        ];
    }
}
