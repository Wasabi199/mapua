<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            // 'user_loan'=>'required|exists:users,id',

            'loan_type'=>'required',
            'loan_amount'=>'required',
            'amount'=>'required',
            // 'department'=>'required',
            'interest'=>'required',
            // 'approval'=>'required',
            'terms'=>'required',
            // 'loan_status'=>'required',
            'attachment1'=>'required',
            // 'attachment2'=>'file|mimes:jpg,png,jpeg,pdf',
            "attachment3"=>'required',

            // 'total_contribution'=>'required',
        ];
    }
}
