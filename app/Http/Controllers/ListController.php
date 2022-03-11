<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lists;
use App\Models\Board;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ListController extends Controller
{
    public function index(Request $request, $board)
    {
        try {

            $lists = Lists::where('board_id', $request->board)->get();

            return response()->json([
                "message" => "success",
                "lists" => $lists
            ], 200);

        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "message" => "board not found"
                ], 404);
            }
            return response()->json([
                "message" => "something went wrong",
                "error" => "{$exception->getMessage()}"
            ], 500);
        }
    }

    public function store(Request $request, $board)
    {
        $this->validate($request, [
            'list' => 'required|string'
        ]);

        try {
            $board = Board::whereId($request->board)->firstOrFail();

            $list = $board->lists()->create([
                'list' => $request->list
            ]);

            return response()->json([
                "message" => "success",
                "list" => $list
            ], 201);

        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    "message" => "board not found"
                ], 404);
            }
            return response()->json([
                "message" => "something went wrong",
                "error" => "{$exception->getMessage()}"
            ], 500);
        } 
    }

    public function update(Request $request, $lists)
    {
        $this->validate($request, [
            "list" => "required|string"
        ]);

        try {

            $list = Lists::whereId($lists)->firstOrFail();

            $list->update([
                "list" => $request->list
            ]);

            return response()->json([
                "message" => "list updated",
                "List" => $list,
            ], 200);

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

    public function destroy(Request $request, $lists)
    {
        $list = Lists::whereId($lists)->first();

        $list->delete();
        return response()->json([
                "message" => "{$list->list} removed",
            ]);
    }
}
