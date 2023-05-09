<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanctumAuthController extends Controller
{
    // for registration
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'require | min:4',
            'email' => 'require | email',
            'password' => 'require | min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Successfully reqistered'], 200);
    }
    // for login
    public function login(Request $request) 
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
         if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->plainTexttoken;
            return reponse()->json(['token' => $token], 200);
         }else{
            return response()->json(['error' => 'Unauthorised'], 401);
         }
    }
}
