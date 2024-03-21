<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function Register(Request $request){
        $validateddata=$request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:riders',
            'password'=>'required|min:8'
        ]);

        $rider =Rider::create([
            'name'=>$request->input('name'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password')
        ]);
    }
}
