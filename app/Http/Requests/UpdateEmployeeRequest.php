<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $id = $this->route('employee');

        return [
            'employee_id' => "required|unique:users,employee_id," . $id,
            'name' => 'required',
            'phone' => ['required','numeric','regex:/^(09|\+?950?9|\+?95950?9)\d{7,9}$/','unique:users,phone,' . $id],
            'email' => 'required|email|unique:users,email,' . $id,
            'nrc_number'=> 'required|unique:users,nrc_number,' .$id,
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'date_of_join' => 'required',
            'roles' => 'required',
            'is_present' => 'required',
            'password' => 'nullable|min:6|max:20',
            'profile_img' => 'nullable|image'
        ];
    }
}
