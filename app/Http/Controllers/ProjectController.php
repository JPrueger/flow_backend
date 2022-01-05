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
                /**
                 * Removes storypoints
                 */
                $assignedUser->storypoints = $userStorypoints - $taskStorypoints;

            } else if($existingTask->status !== 'done' && $task['newStatus'] === 'done') {
                /**
                 * Adds storypoints
                 */
                $assignedUser->storypoints = $userStorypoints + $taskStorypoints;
            }

            $assignedUser->save();
            $existingTask->status = $task['newStatus'];
            $existingTask->sort_index = $index;
            $existingTask->save();
            $tasks->push($existingTask);
        }

        /**
         * Returns tasks as json.
         */
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
        /**
         * Validates request.
         */
        $this->validate($request, [
            'title' => 'required',
        ]);

        /**
         * Creates new project.
         */
        $Project = new Project();
        $Project->title = $request->get('title');
        $Project->save();

        /**
         * Attachess either only logged in user to project, or chosen assignees.
         */
        if($request->get('users') !== null) {
            $userIds = json_decode($request->get('users'));
            $Project->users()->attach([...$userIds, $request->get('user_id')]);
        } else {
            $Project->users()->attach($request->get('user_id'));
        }

        /**
         * Returns newly created project as json.
         */
        return response()->json($Project);
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

    /**
     * Gets project according to ID.
     */
    public function getProject($project_id) {
        $project = Project::findOrFail($project_id);
        return response()->json($project);
    }

    /**
     * Shows projects according to logged in user.
     */
    public function showMyProjects($user_id) {
        $projects = User::findOrFail($user_id)->projects()->get();
        return response()->json($projects);
    }

    /**
     * Gets all projects according to ID.
     */
    public function getAllProjectUsers($project_id) {
        $project = Project::findOrFail($project_id);
        $users = $project->users()->get();
        return response()->json($users);
    }

    /**
     * Gets all task according to project ID.
     */
    public function getAllProjectTasks($project_id) {
        $tasks = Task::query()->where('project_id', $project_id)->get();
        return response()->json($tasks);
    }
}
