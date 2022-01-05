<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Gets all users.
     */
    public function getAllUsers() {
        $users = User::all(['id', 'name', 'email', 'tag_color', 'level_one_played', 'level_two_played', 'level_three_played']);
        return response()->json($users);
    }

    public function checkIfCharacterShouldEvolve($userId) {
        $user = User::findOrFail($userId);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $User = User::find($id);
        $User->level_one_played = $request->get('levelOnePlayed');
        $User->level_two_played = $request->get('levelTwoPlayed');
        $User->level_three_played = $request->get('levelThreePlayed');
        $User->save();

        return response()->json($User);
    }

    /**
     * Edits User.
     */
    public function editUser(Request $request, $id) {
        /**
         * Finds user according to ID.
         */
        $User = User::find($id);

        /**
         * Validates request.
         */
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        /**
         * Updates user with new values.
         */
        $User->name = $request->get('name');
        $User->password = Hash::make($request->get('password'));
        $User->save();

        /**
         * Returns updated user as json.
         */
        return response()->json($User);
    }
}
