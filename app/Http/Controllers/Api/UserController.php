<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function register(Request $request){
        $user = $this->user->create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password'))
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'User created successfully',
            'data'=>$user
        ]);
    }
    public function login(Request $request){
        $credentials = $request->only('name', 'password');
        if (!($token = \JWTAuth::attempt($credentials))) {
            return response()->json([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 401);
        }
        return response()->json(['token' => $token], 200);
    }
    public function getUserInfo(Request $request){
        $user = \Auth::user();
        if($user){
            return \response($user,200);
        }
        return \response(null,404);
    }
}
