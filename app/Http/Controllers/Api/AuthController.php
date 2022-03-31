<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email,except,id',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('my-token');

        return response()->json(['token' => $token->plainTextToken], 200);
    }

     /**
     * Login Req
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>"required|email",
            "password"=>"required"
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('my-token');
            return response()->json(['token' => $token->plainTextToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }
        public function userInfo()
        {
         return response()->json([
             'success'=>true,
             "message"=>"User Info",
             "data"=>auth()->user()
         ], 200);

        }
}
