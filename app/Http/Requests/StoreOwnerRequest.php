<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
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
            '_token' => 'required',
            'confirm_owner_name' => 'required',
            'confirm_phone_number' => 'required',
            'confirm_nrc_no' => 'required',
            'confirm_nrc_location' => 'required',
            'confirm_nrc_type' => 'required',
            'confirm_nrc_number' => 'required',
            'confirm_email' => 'required',
            'confirm_password' => 'required',
            'confirm_address' => 'required',
            'confirm_city' => 'required',
            'confirm_state' => 'required',
            'confirm_org_name' => 'required',
            'confirm_industry' => 'required',
            'confirm_main_address' => 'required',
            'confirm_logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'ammount' => 'required',
            'tax' => 'required',
            'total_ammount' => 'required',
            // 'created_by' => 'required',
        ];
    }
}
