<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $todo = Todo::create($request->all());
        return response()->json([
            "message" => "Todo created successfully",
            "data" => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }

        return response()->json([
            "data" => $todo
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $todo->update($request->all());
        return response()->json([
            "message" => "Todo updated successfully",
            "data" => $todo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }

        $todo->delete();
        return response()->json([
            "message" => "Todo deleted successfully"
        ], 200);
    }
}
