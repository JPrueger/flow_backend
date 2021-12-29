<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::all(['id', 'name', 'email', 'tag_color', 'videoPlayed']);
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
        $this->validate($request, [
            'videoPlayed' => 'required',
        ]);

        $User = User::find($id);
        $User->videoPlayed = $request->get('videoPlayed');
        $User->save();

        return response()->json($User);
    } 
}
