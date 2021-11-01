<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required',
            'account_number' => 'required',
            'id_number' => 'required',
            'tax_number' => 'required',
            'zip_code' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ];       
    }
    
        public static function messagess()
        {
            return [
                'name.required' => 'Name is required!',
                'city.required' => 'city is required',
                'address.required' => 'Address is required',
                'account_number.required' => 'account_number is required',
                'id_number.required' => 'id_number is required',
                'tax_number.required' => 'tax_number is required',
                'zip_code.required' => 'Address is required',
                'email.required' => 'Email is required!',
                'phone_number.required' => 'phone_number is required!',

               
            ];
        }
}

