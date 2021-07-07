<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function getlogin(LoginRequest $request){
        $remember = $request->has('remember') ? True : False ;
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            // notify()->success('تم الدخول بنجاح');
            return redirect()->route('admin.index');
        }
        // notify()->error('خطأ في البيانات الرجاء المحاولة مرة أخرى ');
        return redirect()->back()->with(['error'=>'خطأ في البيانات']);
    }

    public function logout(Request $request) {

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
