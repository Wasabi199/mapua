<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmergencyLoanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'loan_type'=>'required',
            'loan_amount'=>'required',
            'amount'=>'required',
            'interest'=>'required',
            'terms'=>'required',
            'attachment1'=>'file|mimes:jpg,png,jpeg,pdf',
        ];
    }
}
