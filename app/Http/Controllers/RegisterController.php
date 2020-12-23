<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){

        $validator      = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
        ]);

        if($validator->fails()){

            return response()->Json($validator->errors(),400);
        }

        $user = User::Create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        return response()->Json([

            'success'   => true,
            'message'   => 'Register Success !',
            'data'      => $user
        ]);
    }
}
