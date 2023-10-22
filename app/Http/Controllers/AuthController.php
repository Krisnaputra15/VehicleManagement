<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginView(){
        return view('login');
    }

    public function loginProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        if($validator->fails()){
            return redirect()->route('login.view')->with("error",$validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if($user == null || !Hash::check($request->password, $user->password)){
            return redirect()->route('login.view')->with("error","Email atau password salah");
        }

        Auth::login($user);
        Log::channel('activity')->info(request()->ip() . " | User {$user->email} mencoba untuk login pada ".date('Y-m-d H:i:s'));
        return redirect()->route('home');
    }

    public function logout(){
        if(!Auth::check()){
            return redirect()->route('login.view');
        }
        Log::channel('activity')->info(request()->ip()." | User ".Auth::user()->email." telah logout dari sistem");
        Auth::logout();
        return redirect()->route('login.view');
    }
}
