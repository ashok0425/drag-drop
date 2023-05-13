<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */

     public function Register(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
             'confirm_password'=>'required|same:password'
        ]);
        
        if ($validator->fails()) {
            $errors=$validator->errors()->messages();
            $data=[];
            foreach ($errors as $key => $value) {
                $data[]=$value[0];
            }
            return response()->json([
                'status' => 'error',
                'message' => $data
            ], 400);
        }

        try {
       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully Register'
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => 'error',
            'message' => 'Registration Failed!. Please try again later'
        ], 400);
    }

     }


    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            $errors=$validator->errors()->messages();
            $data=[];
            foreach ($errors as $key => $value) {
                $data[]=$value[0];
            }
            return response()->json([
                'status' => 'error',
                'message' => $data
            ], 400);
        }

        try{
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = $request->user()->createToken('login_token')->plainTextToken;
              return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'data'=>$token
        ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Crediential',
            ], 200);
        }

    } catch (\Throwable $th) {
        return response()->json([
            'status' => 'error',
            'message' => 'Login Failed!. Please try again later'
        ], 400);
    }
    }


    public function loadContent(Request $request)
    {
        $cities=config('city');
       return view('frontend.partial',compact('cities'));
    }
}
