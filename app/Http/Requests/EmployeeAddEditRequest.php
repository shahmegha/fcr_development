<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmployeeAddEditRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'employee_name' => ['required', 'string', 'max:255'],
            'employee_email' => ['required','unique:App\Models\Employee,email,'.$request->id],
            'employee_country' => ['required'],
            'employee_state' => ['required'],
            'employee_image' => ['required_if:mode,==,add','mimes:jpeg,png,jpg'],
        ];
    }
}
