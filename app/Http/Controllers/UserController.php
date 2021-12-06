<?php

namespace App\Http\Controllers;

class UserController
{
    public function getAllUsers() {
        $users = User::all();

        return response()->json($users);
    }
}
