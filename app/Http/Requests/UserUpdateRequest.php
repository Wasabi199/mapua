<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->userType == 1;
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
            'id'=>'required|exists:admins,id',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'mobile_number'=>'required',
            'birth_date'=>'required',
            'civil_status'=>'required',

            'department'=>'required',
            'membership'=>'required',
            'employment'=>'required',
          
            
        ];
    }
}
