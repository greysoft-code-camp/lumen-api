<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardCollection;
use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
            $board = Board::find($id);
            if ($board) {
                return response()->json([
                    'board' => new BoardCollection($board)
                ], 200);
            }
            else
            {
                return response()->json([
                    'message' => 'Board not found'
                ], 404);
            }
        }
        elseif ($boards = Auth::user()->boards)
        {
            return response()->json([
                'message' => 'Success',
                'boards' => $boards->map(function($board) {
                    return new BoardCollection($board);
                })
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'No boards available'
            ], 204);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $board = Auth::user()->boards()->create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'success',
            'board' => new BoardCollection($board)
        ], 201);
    }

    public function storeList(Request $request, $board)
    {
        $this->validate($request, [
            'lists' => 'required|array|min:1'
        ]);

        $board = Board::where('id', $request->board)->first();

        if(count($board->lists) > 0) {
            // dd($board->lists);
            $lists = array_merge($board->lists, $request->lists);
            $board->update([
                'lists' => $lists,
            ]);
        } else {
            $board->update([
                'lists' => $request->lists,
            ]);
        }

        return response()->json([
            "message" => "list created",
            "list" => $board->lists,
        ]);
    }
}