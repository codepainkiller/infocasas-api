<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

use App\Http\Resources\V1\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $task = Task::create([
            'name' => $request->name,
            'completed' => false
        ]);

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $task->update($request->all());

        return new TaskResource($task);
    }
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Success'
        ], 204);
    }
}
