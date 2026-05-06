<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Event::query()->orderBy('id')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'startHour' => ['sometimes', 'nullable', 'numeric'],
            'endHour' => ['sometimes', 'nullable', 'numeric'],
            'colorValue' => ['sometimes', 'nullable', 'string', 'max:255'],
            'date_event' => ['sometimes', 'nullable', 'date'],
        ]);

        $event = Event::create($data);

        return response()->json($event, 201);
    }

    public function show(Event $event): JsonResponse
    {
        return response()->json($event);
    }

    public function update(Request $request, Event $event): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'startHour' => ['sometimes', 'nullable', 'numeric'],
            'endHour' => ['sometimes', 'nullable', 'numeric'],
            'colorValue' => ['sometimes', 'nullable', 'string', 'max:255'],
            'date_event' => ['sometimes', 'nullable', 'date'],
        ]);

        $event->update($data);

        return response()->json($event->refresh());
    }

    public function destroy(Event $event): JsonResponse
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
