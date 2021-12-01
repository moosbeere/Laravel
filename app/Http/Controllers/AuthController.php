<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.registration');
    }

    public function login(){
        error_log('try');
        return view('auth.signin');
    }

    public function registration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|min:6'
        ]
        );

        $newuser = new User();
        $newuser->name = $request->input('name');
        $newuser->email = $request->input('email');
        $newuser->password = Hash::make($request->input('password'));
        $newuser->save();

        return redirect('/auth/signin')->withSuccess('Регистрация прошла успешно');
    }

    public function customLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            return redirect('/articles')->withSuccess('Авторизация пройдена');
        }

        return redirect('/auth/signin');
    }

    public function signOut(){
        Auth::logout();
        return redirect('/auth/signin');
    }
}
