<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required',
            'regional' => 'required',
            'outlet' => 'required',
            'add_postalcode' => 'required',
            'add_province' => 'required',
            'add_regency' => 'required',
            'add_subdistrict' => 'required',
            'add_village' => 'required',
            'add_road' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthdate' => 'required',
            'lic_number' => 'required',
            'lic_date' => 'required',
            'tax_number' => 'required',
        ];
    }
}
