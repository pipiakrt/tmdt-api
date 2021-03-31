<?php namespace Modules\Account\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            //'email' => 'unique:users',
            'username' => 'required|unique:users',
            'phone' => 'required|min:10|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|confirmed|min:6',
            //'referral'=>'required'
        ];
    }

    public function messages()
    {
        return [
            //'email.required' =>  __('Vui lòng nhập email.'),
            //'email.email' => __('Vui lòng nhập đúng email.'),
            //'email.unique' => __('Email này đã đăng ký.'),
            'username.required' =>  __('Vui lòng nhập tên đăng nhập.'),
            'username.unique' => __('Tên đăng nhập này đã đăng ký.'),
            'phone.required' =>  __('Vui lòng nhập SĐT.'),
            'phone.unique' => __('SĐT này đã đăng ký.'),
            'phone.min' => __('Vui lòng nhập đúng SĐT.', ['minlength' => 10]),
            'first_name.required' =>  __('Vui lòng nhập Tên.'),
            'first_name.string' => __('Tên phải là chữ.'),
            'last_name.required' =>  __('Vui lòng nhập Họ & đệm.'),
            'last_name.string' => __('Họ phải là chữ.'),
            'password.required' =>  __('Chưa nhập mật khẩu.'),
            'password.confirmed' => __('Hai mật khẩu không trùng nhau.'),
            'password.min' => __('Mật khẩu quá ngắn.', ['minlength' => 6]),
            //'referral.required' =>  __('Bạn chưa có người bảo hộ'),
        ];
    }
}
