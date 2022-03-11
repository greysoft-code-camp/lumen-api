<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lists;
use App\Http\Resources\TaskCollection;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TaskController extends Controller
{
    public function index($lists)
    {
        $tasks = Task::whereId($lists)->first();
        if($tasks){
            return response()->json([
                "message" => "success",
                "tasks" => new TaskCollection($tasks)
            ], 200);
        } else {
            return response()->json([
                "message" => "no tasks",
            ], 200);
        }
    }

    public function store(Request $request, $lists)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        try {
            
            $list = Lists::whereId($lists)->firstOrFail();
    
            $task = $list->tasks()->create([
                'name' => $request->name
            ]);
    
            return response()->json([
                'message' => 'success',
                'task' => new TaskCollection($task)
            ], 201);

        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "message" => "list not found"
                ], 404);
            }
            return response()->json([
                "message" => "something went wrong",
                "error" => "{$exception->getMessage()}"
            ], 500);
        }
    }

    public function update(Request $request, $task)
    {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        try {

            $task = Task::whereId($task)->firstOrFail();

            $task->update([
                "name" => $request->name
            ]);

            return response()->json([
                "message" => "task updated",
                "task" => new TaskCollection($task),
            ], 200);

        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "message" => "task not found"
                ], 404);
            }
            return response()->json([
                "message" => "something went wrong",
                "error" => "{$exception->getMessage()}"
            ], 500);
        }
    }

    public function destroy(Request $request, $task)
    {
        $task = Task::whereId($task)->first();
        $task->delete();
        return response()->json([
            "message" => "success",
        ], 200);
    }
}