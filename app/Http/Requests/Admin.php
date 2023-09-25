<?php

namespace App\Http\Requests;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class Admin extends FormRequest
{
    use PasswordValidationRules;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'first_name'=>'required',
            'middle_name' =>'required',
            'last_name' => 'required',
            'birth_date'=>'required',
            'birth_place'=>'required',
            'mobile_number' => 'required',
            'civil_status'=>'required',
           
            'department' => 'required',
            // 'salary' => 'required',

            'membership' => 'required',
            'employment' => 'required',

            'account_information.email'=>'required|email|unique:users,email',
            'account_information.password' => 'required',
            'account_information.role' => 'required',
            'account_information.member_id'=>'required',
        ];
    }
}
