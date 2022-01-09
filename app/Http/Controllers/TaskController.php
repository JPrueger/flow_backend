<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $allTasks = Task::query()->where('project_id', $project_id)->orderBy('created_at', 'desc')->get();
        return response()->json($allTasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validates request.
         */
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:500',
            'storypoints' => 'required',
            'status' => 'required',
        ]);

        /**
         * Creates new task.
         */
        $Task = new Task();
        $Task->title = $request->get('title');
        $Task->description = $request->get('description');
        $Task->storypoints = $request->get('storypoints');
        $Task->status = $request->get('status');
        $Task->project_id = $request->get('project_id');
        $Task->assigne_id = $request->get('assigne_id');
        $Task->save();

        /**
         * Returns newly created task as json.
         */
        return response()->json($Task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
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
        /**
         * Validates request.
         */
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:500',
            'storypoints' => 'required',
            'status' => 'required',
        ]);

        /**
         * Updates task according to ID.
         */
        $Task = Task::find($id);
        $Task->title = $request->get('title');
        $Task->description = $request->get('description');
        $Task->storypoints = $request->get('storypoints');
        $Task->status = $request->get('status');
        $Task->project_id = $request->get('project_id');
        $Task->assigne_id = $request->get('assigne_id');
        $Task->save();

        /**
         * Returns updated task as json.
         */
        return response()->json($Task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Task = Task::find($id);
        $Task->delete();
        return response()->json($Task);
    }

    /**
     * Updates storypoints according to task ID.
     */
    public function updateStoryPoints($taskId) {
        $task = Task::findOrFail($taskId);
        $user = User::findOrFail($task->assigne_id);
        $currentStoryPoints = $user->storypoints;
        $taskStoryPoints = $task->storypoints;
        $user->storypoints = $currentStoryPoints + $taskStoryPoints;
        return response()->json($task);
    }
}
