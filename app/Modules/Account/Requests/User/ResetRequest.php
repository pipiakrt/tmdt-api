<?php namespace Modules\Account\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
    protected $passLen;
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' =>  __('Vui lòng nhập email.'),
            'email.email' => __('Vui lòng nhập đúng email.'),
            'password.required' =>  __('Chưa nhập mật khẩu.'),
            'password.confirmed' => __('Hai mật khẩu không trùng nhau.'),
            'password.min' => __('Mật khẩu quá ngắn.', ['minlength' => 6])
        ];
    }
}
