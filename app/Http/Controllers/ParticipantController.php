<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::all();


        if ($participants->count() > 0) {
            return response()->json($participants, 200);
        }

        return response()->json([
            'message' => 'No Participants Listed.'
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
            'participant_name' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);

        $participant = Participant::create($validated);

        if ($participant) {
            return response()->json([
                'message' => 'Participant created',
                'data' => $participant
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $participant = Participant::findOrFail($id);

        return response()->json($participant,201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'message' => 'Participant not found'
            ], 404);
        }

        $validated = $request->validate([
            'participant_name' => 'sometimes|string',
            'event_id' => 'required|exists:events,id',
        ]);

        $participant->update($validated);

        return response()->json([
            'message' => 'Participant updated',
            'data' => $participant
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'message' => 'Participant not found'
            ], 404);
        }

        $participant->delete();

        return response()->json([
            'message' => 'Participant deleted'
        ], 200);
    }
}
