<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'department' => 'required',
            'user' => 'required',
            'contact_phone' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'department' => '部门',
            'user' => '使用人',
            'contact_phone' => '电话',
        ];
    }
}
