<?php

namespace  Modules\Booths\Requests\Booth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' =>  'required|',
            'user_id' => 'required|'
        ];
    }

    public function messages()
    {
        return [
            // 'email.unique' =>  __('Email này đã tồn tại'),
            // 'user_id.unique' =>  __('Gian hàng của bạn đã tồn tại.'),

        ];
    }
}
