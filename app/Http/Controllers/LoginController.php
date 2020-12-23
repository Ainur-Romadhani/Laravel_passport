<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function Login(Request $request){

        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if($validator->fails()){

            return response()->Json($validator->errors(),400);
        }

        $user = User::Where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password)){

            return response()->Json([
                'success' => false,
                'message' => 'Gagal Login'
            ]);
        }
            return response()->Json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data'    => $user,
                'token'   => $user->createToken('authToken')->accessToken
            ]);
        }
        
        public function logout(Request $request){

            $removeToken = $request->user()->tokens()->delete();

            if($removeToken) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout Success!',  
                ]);
            }
        }

        
}
