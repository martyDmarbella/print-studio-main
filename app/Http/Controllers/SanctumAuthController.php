<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SanctumAuthController extends Controller
{
    // for registration
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Successfullay reqistered'], 200);
    }
    // for login
    public function login(Request $request) {

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

         if (auth()->attempt($data)) {
         $token = auth()->user()->createToken('LaravellAuthApp')->plainTextToken;
         return response()->json(['token'=> $token], 200);
         }else{
            return response()->json(['error' => 'Unauthorised'], 401);
         }
    }
}
