<?php

namespace  Modules\Account\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    protected $passLen;


    public function __construct()
    {
        $this->passLen = 6;
    }

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
            'password_old' =>  'required|min:' . $this->passLen,
            'password' => 'required|confirmed|min:' . $this->passLen
        ];
    }

    public function messages()
    {
        return [
            'password_old.required' =>  __('Chưa nhập mật khẩu hiện tại.'),
            'password_old.min' => __('Mật khẩu hiện tại quá ngắn.', ['minlength' => $this->passLen]),
            'password.required' =>  __('Chưa nhập mật khẩu mới.'),
            'password.confirmed' => __('Hai mật khẩu không trùng nhau.'),
            'password.min' => __('Mật khẩu mới quá ngắn.', ['minlength' => $this->passLen])
        ];
    }
}
