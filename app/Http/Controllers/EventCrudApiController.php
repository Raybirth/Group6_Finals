<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventCrudApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Events::all());
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
        'event_name'    => 'required|string',
        'event_date'    => 'required|date',
        'event_address' => 'required|string',
        ]);

        $event = Events ::create($validated);

        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Events::findOrFail($id);

        return response()->json($post,201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $event_crud_api)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Events::findOrFail($id);
        $event->update($request->all());
        return response()->json($event,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Events::destroy($id);
        return response()->json(['Event deleted' => true]);
    }
}
