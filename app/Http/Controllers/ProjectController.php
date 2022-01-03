<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        $tasks = collect([]);
        foreach ($request->all() as $index => $task) {
            $existingTask = Task::findOrFail($task['id']);

            $assignedUser = User::findOrFail($existingTask->assigne_id);
            $userStorypoints = $assignedUser->storypoints;
            $taskStorypoints = $existingTask->storypoints;

            if($existingTask->status === 'done' && $task['newStatus'] !== 'done') {
                //remove storypoints
                $assignedUser->storypoints = $userStorypoints - $taskStorypoints;

            } else if($existingTask->status !== 'done' && $task['newStatus'] === 'done') {
                //add storypoints
                $assignedUser->storypoints = $userStorypoints + $taskStorypoints;
            }

            $assignedUser->save();
            $existingTask->status = $task['newStatus'];
            $existingTask->sort_index = $index;
            $existingTask->save();
            $tasks->push($existingTask);
        }
        return response()->json($tasks);
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
        $Project->save();

        if($request->get('users') !== null) {
            $userIds = json_decode($request->get('users'));
            $Project->users()->attach([...$userIds, $request->get('user_id')]);
        } else {
            $Project->users()->attach($request->get('user_id'));
        }

        return response()->json($Project);
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
        $project = Project::find($id);
        $project->delete();

        return response()->json($project);
    }

    public function getProject($project_id) {
        $project = Project::findOrFail($project_id);
        return response()->json($project);
    }

    public function showMyProjects($user_id) {
        $projects = User::findOrFail($user_id)->projects()->get();
        return response()->json($projects);
    }

    public function getAllProjectUsers($project_id) {
        //get all users from this projevt
        $project = Project::findOrFail($project_id);
        $users = $project->users()->get();
        return response()->json($users);
    }

    public function getAllProjectTasks($project_id) {
        //get all tasks from specific project
        $tasks = Task::query()->where('project_id', $project_id)->get();
        return response()->json($tasks);
    }
}
