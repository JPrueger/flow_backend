<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email','password']);

        if (auth()->attempt($credentials)) {

            $token = Auth::user()->createToken('auth');


            return response()->json([
                'token' => $token->plainTextToken,
                'user' => Auth::user(),
            ]);
        } 

        throw ValidateException::withMessage([
            'email' => ['Incorrect Email or Password!']
        ]);       
    }

    

}