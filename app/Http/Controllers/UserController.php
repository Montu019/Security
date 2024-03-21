<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     
    public function Register(Request $request){
        $validatedata=$request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
        ]);
        $user = User::create([
            'name' => $validatedata['name'],
            'email' => $validatedata['email'],
            'password' =>$validatedata['password']
        ]);
    }

    // public function login(Request $request){
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required',
    //     ]);
    //     $user = User::where('email',$request->email)->first();

    //     if(!$user || !Hash::check($request->password,$user->password)){
    //         throw ValidationException::withMessages([
    //             'email'=>['The provided credentials are incorrect.'],
    //         ]);
    //     }
    //     return response()->json(['user'=>$user,]);
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         // $token = $user->createToken('MyApp')->accessToken;
    //         // return response()->json(['token' => $token]);
    //         return 'ok';
    //     }
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }

    public function login(Request $request)
    {
        // $user = User::where('id',4)->get();
        $user = User::where('email', $request->email)->first();
        if ($user && $request->password == $user->password) {
            $token = $user->createToken($request->email)->plainTextToken;
            // return $this->sendSuccessResponse(__('User Loggedin Successfully'), null, $token);
            return $token;
        }
        return response([
            'messsage' => 'Unauthorized User',
            'status' => 'failed'    
        ], 401);
    }

    

}
