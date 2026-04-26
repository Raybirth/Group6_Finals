<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::all();

        if ($events->count() > 0) {
            return response()->json($events, 200);
        }

        return response()->json([
            'message' => 'No Events Listed.'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'event_name' => 'required|string',
            'event_date' => 'required|date',
            'event_address' => 'required|string',
        ]);

        $event = Events::create($validated);

        if ($event) {
            return response()->json([
                'message' => 'Event created',
                'data' => $event
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create event'
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $event = Events::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json($event, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $event = Events::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        $validated = $request->validate([
            'event_name' => 'sometimes|string',
            'event_date' => 'sometimes|date',
            'event_address' => 'sometimes|string',
        ]);

        $event->update($validated);

        return response()->json([
            'message' => 'Event updated',
            'data' => $event
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events, $id)
    {
        $event = Events::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        $event->delete();

        return response()->json([
            'message' => 'Event deleted'
        ], 200);
    }
}
