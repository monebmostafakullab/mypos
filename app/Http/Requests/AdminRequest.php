<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required', Rule::unique('admins', 'email')->ignore($this->admin)],
            'mobile'=>['required',Rule::unique('admins', 'mobile')->ignore($this->admin)],
            'image'=>'image|mimes:png,jpg,jpeg,gif',
            'password'=>'required_without:id|confirmed',

        ];

    }

    public function messages()
    {
        return [
            'password.required_without'=> __('site.password_required') ,
        ];
    }
}
