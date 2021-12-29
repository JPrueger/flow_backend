<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $tokenObj = Auth::user()->createToken('auth');

            return response()->json([
                'token' => $tokenObj->plainTextToken,
                'user' => Auth::user(),
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['Email or Password are incorect.']
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'character_id' => 'nullable'
        ]);

        $ColourCodes = array(
            'berry' => '#99154E',
            'yellow' => '#FFB319',
            'light-blue-green' => '#49A6AA',
            'dark-blue-green' => '#0A474A'
        );

        // create new user account
        $User = new User();
        $User->name = $request->get('name');
        $User->email = $request->get('email');
        $User->character_id = null;
        $User->password = Hash::make($request->get('password'));
        $User->tag_color = $ColourCodes[array_rand($ColourCodes)];
        $User->save();

        // return newly created user data
        return response()->json($User);
    }

    /**
     * Returns the logged in users data
     */
    public function me()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }

    public function getUserData($user_id)
    {
        $user = User::find($user_id);
        return response()->json($user);
    }
}
