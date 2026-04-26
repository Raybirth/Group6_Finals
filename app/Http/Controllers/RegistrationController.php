<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::all();

        if ($registrations->count() > 0) {
            return response()->json($registrations, 200);
        }

        return response()->json([
            'message' => 'No registrations found'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'participant_id' => 'required|integer',
            'event_id' => 'required|integer',
        ]);

        $registration = Registration::create($validated);

        if ($registration) {
            return response()->json([
                'message' => 'Registration created',
                'data' => $registration
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create registration'
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration, $id)
    {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json([
                'message' => 'Registration not found'
            ], 404);
        }

        return response()->json($registration, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration, $id)
    {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json([
                'message' => 'Registration not found'
            ], 404);
        }

        $validated = $request->validate([
            'participant_id' => 'sometimes|integer',
            'event_id' => 'sometimes|integer',
        ]);

        $registration->update($validated);

        return response()->json([
            'message' => 'Registration updated',
            'data' => $registration
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration, $id)
    {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json([
                'message' => 'Registration not found'
            ], 404);
        }

        $registration->delete();

        return response()->json([
            'message' => 'Registration deleted'
        ], 200);
    }
}
