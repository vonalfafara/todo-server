<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\Status;

class TodoController extends Controller
{
    public function index(Request $request) {
        $limit = $request->query('limit') ? (int) $request->query('limit') : 15;
        return $request;
        $query = Todo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate($limit);

        return TodoResource::collection($query);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Todo::create([
            'user_id' => auth()->user()->id,
            'status_id' => 1,
            'name' => $fields['name'],
            'description' => $fields['description']
        ]);

        return response([
            'message' => 'Todo item created'
        ], 201);
    }

    public function update(Request $request, string $id) {
        $todo = Todo::find($id);

        if (!$todo) {
            return response([
                'message' => 'Todo does not exist'
            ], 404);
        }

        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status_id' => 'required|numeric'
        ]);

        $todo->update([
            'name' => $fields['name'],
            'description' => $fields['description'],
            'status_id' => $fields['status_id']
        ]);

        return response([
            'message' => 'Todo updated'
        ], 200);
    }

    public function destroy(string $id) {
        $todo = Todo::find($id);

        if (!$todo) {
            return response([
                'message' => 'Todo does not exist'
            ], 404);
        }

        $todo->delete();

        return response([
            'message' => 'Todo deleted'
        ], 200);
    }
}
