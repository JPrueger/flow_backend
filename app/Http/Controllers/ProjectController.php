<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        // dd($request->all());
        $tasks = collect([]);
        foreach ($request->all() as $index => $task) {
            // dd($task['id']);
            $existingTask = Task::findOrFail($task['id']);
            $existingTask->status = $task['newStatus'];
            $existingTask->sort_index = $index;
            $existingTask->save();
            $tasks->push($existingTask);
            //Task::where("id", $task['id'])->update(["sort_index" => $index])->save();
            //Task::where("id", $task['id'])->update(["status" => $task['status']]);
        }
        return response()->json($tasks);
        //return response()->status(200)
        // return response('Success', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $Project = new Project();
        $Project->title = $request->get('title');
        // $Project->user_id = $request->get('user_id');
        $Project->save();

        $userIds = json_decode($request->get('users'));
        $Project->users()->attach([...$userIds, $request->get('user_id')]);

        // return newly created user data
        return response()->json($Project);

        //get all users from this projevt
        //$project->users();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showMyProjects($user_id) {

        $projects = Project::query()->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return response()->json($projects);
    }
}
