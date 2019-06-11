<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request){
        $regis = new Admin();
        $regis->name = $request->name;
        $regis->email = $request->email;
        $regis->password = Hash::make($request->password);
        $regis->remember_token = $request->_token;

        $regis->save();

        return redirect(route('admin.index'));
    }
}
