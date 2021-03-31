<?php namespace Modules\Account\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $passLen = 6;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//
//    public function __construct()
//    {
//        $this->passLen = config('site.password_length');
//    }

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
        $id = $this->input('id');
        return [
            'phone' => 'min:10|nullable|unique:users,phone,' . $id.',id',
            'password' => 'confirmed|min:' . $this->passLen
        ];
    }

    public function messages()
    {
        return [
            //'phone.required' =>  __('Vui lòng nhập SĐT.'),
            'phone.unique' => __('SĐT này đã đăng ký.'),
            'phone.min' => __('Vui lòng nhập đúng SĐT.', ['minlength' => 10]),
            'password.confirmed' => __('Password do not match'),
            'password.min' => __('Password too short', ['minlength' => $this->passLen])
        ];
    }

}
