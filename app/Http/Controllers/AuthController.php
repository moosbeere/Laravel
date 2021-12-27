<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    // front on laravel
    public function index(){
        return view('auth.registration');
    }

    public function customLogin(){
        return view('auth.signin');
    }

    //api routing
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
        
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)){
            return response([
                'message' => 'Bad login', 401
            ]);

        }
        $user = User::where('email', $request->input('email'))->first();
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response, 201);

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
