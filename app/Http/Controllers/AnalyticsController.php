<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Registration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function participantsPerEvent()
    {
    $data = Events::select('events.id', 'events.event_name')
        ->leftJoin('participants', 'events.id', '=', 'participants.event_id')
        ->selectRaw('COUNT(participants.id) as total_participants')
        ->groupBy('events.id', 'events.event_name')
        ->orderByDesc('total_participants')
        ->get();

    return response()->json($data, 200);
    }

    public function mostPopularEvent()
    {
    $event = Events::select('events.id', 'events.event_name')
        ->leftJoin('participants', 'events.id', '=', 'participants.event_id')
        ->selectRaw('COUNT(participants.id) as total_participants')
        ->groupBy('events.id', 'events.event_name')
        ->orderByDesc('total_participants')
        ->first();

    if (!$event) {
        return response()->json([
            'message' => 'No events found'
        ], 200);
    }

    return response()->json($event, 200);
    }

     public function totalRegistrations()
    {
        $total = Registration::count();

        return response()->json([
            'total_registrations' => $total
        ], 200);
    }
}
