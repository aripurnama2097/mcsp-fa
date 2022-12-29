<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPartRequest extends FormRequest
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

    //  SETTING VALIDASI
    public function rules()
    {
        return [
            'rog_number'=>'required',
            'part_number'=>'required',
            'qty_request'=>'required',
            'register_by'=>'required',
        ];
    }
}
