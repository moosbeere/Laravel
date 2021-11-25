<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function index(){
        return view('login');
    }

    public function customLogin(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            return redirect('articles')->withSuccess('Вход выполнен');
        }

        return redirect('login')->withSuccess('Авторизация не пройдена');
    }

    public function registration(){
        return view('registration');
    }

    public function customRegistration(Request $request){
        
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            // 'email' => 'unique:App\Models\User,email'
            'password'=>'required|min:6'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('login');

    }
    public function signOut(){
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}

