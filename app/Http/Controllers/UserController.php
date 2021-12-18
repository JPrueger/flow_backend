<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::all(['id', 'name', 'email', 'tag_color']);
        return response()->json($users);
    }

    public function checkIfCharacterShouldEvolve($userId) {
        $user = User::findOrFail($userId);
        $userStorypoints = $user->storypoints;
    }
}
