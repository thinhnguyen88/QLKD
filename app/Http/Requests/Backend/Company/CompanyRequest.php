<?php
namespace App\Http\Requests\Backend\Company;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CompanyRequest extends Request{

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
            'company_name'  => ['required' , 'max:191' , Rule::unique('company')],
            'address'  => 'required|max:191',
            'tax_identification_number'  => 'required|numeric',
            'person_charge'  => 'required|max:191',
            'person_charge_phone_number'  => 'required|numeric',
            'person_charge_email_address'  => 'required|email|max:191',

        ];
    }
}