<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'phone_number' => 'required',
            'nrc_no' => 'required',
            'nrc_location' => 'required',
            'nrc_type' => 'required',
            'nrc_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'org_name' => 'required',
            'industry' => 'required',
            'main_address' => 'required',
            'logo' => 'required',
        ];
    }
}
