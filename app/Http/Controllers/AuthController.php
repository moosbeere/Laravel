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

    // public function index(){
    //     return view('login');
    // }

    public function login(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $user = User::where('email', $request->input('email'))->first();
            $token =$user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' =>$token
            ];
            return response($response, 201);
        }

        return response([
            'message' => 'Bad login'
        ], 401);
    }

    // public function registration(){
    //     return view('registration');
    // }

    public function registration(Request $request){
        
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => '2'
        ]);

        $token =$user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' =>$token
            ];
            return response($response, 201);

    }
    public function signOut(){
        auth()->user()->tokens()->delete();
        // Session::flush();
        // Auth::logout();

        return response([
            'message' => 'Logged out'
        ]);
    }
}

