<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => '2'
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response, 201);
        // $newuser = new User();
        // $newuser->name = $request->input('name');
        // $newuser->email = $request->input('email');
        // $newuser->password = Hash::make($request->input('password'));
        // $newuser->save();

        // return redirect('/auth/signin')->withSuccess('Регистрация прошла успешно');
    }

    public function customLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)){
            return response([
                'message' => 'Bad login', 401
            ]);
        // return redirect('/auth/signin');

        }
        $user = User::where('email', $request->input('email'))->first();
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response, 201);
            // return redirect('/articles')->withSuccess('Авторизация пройдена');

    }

    public function signOut(){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
        
        // Auth::logout();
        // return redirect('/auth/signin');
    }
}
