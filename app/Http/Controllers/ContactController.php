<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $bla=[
            'adres'=>'Большая семеновская',
            'tel'=>'8(495)232-2323',
            'email'=>'@mospolitech.ru'
        ];


        return view('contact', ['name'=>$bla]);
    }

}

