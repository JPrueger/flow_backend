<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::all(['id', 'name', 'email', 'tag_color', 'level_one_played', 'level_two_played', 'level_three_played']);
        return response()->json($users);
    }

    public function checkIfCharacterShouldEvolve($userId) {
        $user = User::findOrFail($userId);
        $userStorypoints = $user->storypoints;
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
        // $this->validate($request, [
        //     'levelOnePlayed' => 'required',
        // ]);

        $User = User::find($id);
        $User->level_one_played = $request->get('levelOnePlayed');
        $User->level_two_played = $request->get('levelTwoPlayed');
        $User->level_three_played = $request->get('levelThreePlayed');
        $User->save();

        return response()->json($User);
    } 
}
