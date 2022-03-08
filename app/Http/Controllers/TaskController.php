<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Board;
use App\Http\Resources\TaskCollection;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $tasks = Auth::user()->tasks()->count();
        dd($tasks);
    }

    public function create()
    {

    }

    public function store(Request $request, $board)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $board = Board::where('id', $request->board)->first();
        

        $task = $board->tasks()->create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'success',
            'task' => new TaskCollection($task)
        ], 201);

    }
}