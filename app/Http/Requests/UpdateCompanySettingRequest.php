<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
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
            'company_name' => 'required',
            'company_email' => 'required',
            'company_phone' => ['required', 'numeric', 'regex:/^(09|\+?950?9|\+?95950?9)\d{7,9}$/'],
            'company_address' => 'required',
            'office_start_time' => 'required',
            'office_end_time' => 'required',
            'break_start_time' => 'required',
            'break_start_time' => 'required',
        ];
    }
}
