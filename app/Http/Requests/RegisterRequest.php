<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|unique:admins,name|max:225',
            'email'=>'required|email|unique:admins,email|max:225',
            'password'=>'required|min:6|max:225|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Những trường có gắn * bạn không được bỏ trống',
            'name.unique'=>'Tên người dùng đã tồn tại! Vui lòng chọn tên khác',
            'name.max'=>'Tên người dùng quá dài. Tối đa 225 ký tự',
            'email.required'=>'Những trường có gắn * bạn không được bỏ trống',
            'email.email'=>'Email bạn nhâp không đúng định dạng',
            'email.unique'=>'Email đã tồn tại! Vui lòng chọn Email khác',
            'email.max'=>'Email quá dài. Tối đa 225 ký tự',
            'password.required'=>'Những trường có gắn * bạn không được bỏ trống',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài',
            'password.confirmed'=>'Mật khẩu nhập lại không khớp',
        ];
    }
}
