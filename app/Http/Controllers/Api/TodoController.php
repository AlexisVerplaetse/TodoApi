<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Todo::query()->orderBy('id')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'fait' => ['sometimes', 'nullable', 'integer'],
        ]);

        $todo = Todo::create($data);

        return response()->json($todo, 201);
    }

    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'fait' => ['sometimes', 'nullable', 'integer'],
        ]);

        $todo->update($data);

        return response()->json($todo->refresh());
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json(null, 204);
    }
}
