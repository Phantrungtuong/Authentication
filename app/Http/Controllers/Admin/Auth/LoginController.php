<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Validator;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $req){
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6|max:225'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu quá ngắn. Tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu quá dài. Tối đa 225 ký tự'
        ];

        $validator = Validator::make($req->all(), $rules, $messages );
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $email = $req->input('email');
            $password = $req->input('password');
            if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $req->get('remember'))) {
                return redirect()->intended(route('admin.index'));

            } else {
                $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }

    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
