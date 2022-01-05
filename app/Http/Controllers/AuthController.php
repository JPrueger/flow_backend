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
        /**
         * Validates request.
         */
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /**
         * Creates token.
         */
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
        /**
         * Validates request.
         */
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'characterId' => 'required'
        ]);

        /**
         * Provides different colours to randomly add them to each user.
         */
        $ColourCodes = array(
            'berry' => '#99154E',
            'yellow' => '#FFB319',
            'light-blue-green' => '#49A6AA',
            'dark-blue-green' => '#0A474A',
            'purple' => '#4A0049',
            'dark-blue' => '#000E41',
            'red-brown' => '#7E1000',
            'grey' => '#7E1000'
        );

        /**
         * Creates new user.
         */
        $User = new User();
        $User->name = $request->get('name');
        $User->email = $request->get('email');
        $User->character_id = $request->get('characterId');;
        $User->character_name = $request->get('characterName');;
        $User->password = Hash::make($request->get('password'));
        $User->tag_color = $ColourCodes[array_rand($ColourCodes)];
        $User->save();

        /**
         * Returns newly created user data as json.
         */
        return response()->json($User);
    }

    /**
     * Returns the logged in user.
     */
    public function me()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }

    /**
     * Gets the current user.
     */
    public function getUserData($user_id)
    {
        $user = User::find($user_id);
        return response()->json($user);
    }
}
