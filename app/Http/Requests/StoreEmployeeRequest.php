<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'employee_id' => "required|unique:users,employee_id",
            'name' => 'required',
            'phone' => ['required','unique:users,phone','numeric','regex:/^(09|\+?950?9|\+?95950?9)\d{7,9}$/'],
            'email' => 'required|unique:users,email|email',
            'nrc_number'=> 'required|unique:users,nrc_number',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'date_of_join' => 'required',
            'is_present' => 'required',
            'password' => 'required|min:6|max:20',
        ];
    }
}
