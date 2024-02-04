<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalReimbursmentRequest extends FormRequest
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
        $isRequired = Rule::requiredIf(!$this->input('in_patient'));
        return [
            //
            'reimbursment_type' => 'required',
            'amount' => 'required',
            'medical_benifit' => 'required',
            'clinic_name' => 'required',
            'appointment_date' => 'required',
            'medical_record1' => 'required',
            'medical_record2' => $isRequired,
            'hospital' => 'required',
            'health' => 'required',
            'eye' => 'required',
            'dental' => 'required',
            'mental' => 'required',
            'in_patient'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'medical_benifit.required' => 'The Medical Benefit is required'

        ];
    }
}
