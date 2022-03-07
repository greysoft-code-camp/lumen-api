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
                'message' => 'No baords available'
            ], 204);
        }
    }

    public function store(Request $request)
    {
        # code...
    }
}