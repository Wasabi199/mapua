<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardsUpdate extends FormRequest
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
            'chairman' => 'required',
            'committee_chairman' => 'required',
            // 'benefits_chairman' => 'required',
            'vice_chairman' => 'required',
            'corporate_secretary' => 'required',
            'treasurer' => 'required',
            'internal_auditor' => 'required',
            'accountant' => 'required',
        ];
    }
}
