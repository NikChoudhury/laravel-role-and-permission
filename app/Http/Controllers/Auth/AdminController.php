<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Hash;
use Auth;

class AdminController extends Controller
{
    // Show Login Form

    public function login(Type $var = null)
    {
        return view('auth.admin.login');
    }

    // Login Form Submit
    public function login_submit(LoginRequest $request)
    {
        $user=User::where('email',$request['email'])->first();
        if(isset($user)&&Hash::check($request['password'],$user['password'])){
 
            Auth::guard('admin')->login($user);
            Auth::shouldUse('admin');

            return redirect()->route("admin.dashboard");
        }else{
            session()->flash('failed',__('Wrong email or password'));
            return redirect()->back();
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
