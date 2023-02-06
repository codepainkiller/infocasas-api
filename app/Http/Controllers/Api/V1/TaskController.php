<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

use App\Http\Resources\V1\TaskResource;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('completed')) {
            $tasks->where('completed', $request->completed);
        }

        if ($request->has('name')) {
            $tasks->where('name', 'like', "%{$request->name}%");
        }

        return TaskResource::collection($tasks->latest()->get());
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
            'name' => 'string',
            'completed' => 'boolean'
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
