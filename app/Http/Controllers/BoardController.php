<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardCollection;
use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class BoardController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
            $board = Board::find($id);
            if ($board) {
                return response()->json([
                    "board" => new BoardCollection($board)
                ], 200);
            }
            else
            {
                return response()->json([
                    "message" => "Board not found"
                ], 404);
            }
        }
        elseif ($boards = Auth::user()->boards)
        {
            return response()->json([
                "message" => "success",
                "boards" => $boards->map(function($board) {
                    return new BoardCollection($board);
                })
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "No boards available"
            ], 204);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        $board = Auth::user()->boards()->create([
            'name' => $request->name
        ]);

        return response()->json([
            "message" => "success",
            "board" => new BoardCollection($board)
        ], 201);
    }

    public function update(Request $request, $board)
    {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        try {

            $b = Board::whereId($board)->firstOrFail();

            $b->update(["name" => $request->name]);
    
            return response()->json([
                "message" => "success",
                "board" => new BoardCollection($board) 
            ], 200);

        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "message" => "board not found"
                ], 404);
            }
            return response()->json([
                "message" => "something went wrong - {$exception->getMessage()}"
            ], 500);
        }

    }

    public function destroy(Request $request, Board $board)
    {
        $board->delete();
        return response()->json([
            "message" => "success"
        ], 200);
    }
}