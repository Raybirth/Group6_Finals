<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AnalyticsController;
use App\Models\Events;

Route::get('/admin', function (Request $request) {
    return response()->json(['message' => 'Welcome admin']);
})->middleware('auth.basic');

Route::middleware('auth.basic')->group(function (){
    Route::apiResource('events', EventsController::class);
    Route::apiResource('participants', ParticipantController::class);
    Route::apiResource('reg', RegistrationController::class);

    Route::prefix('analytics')->group(function () {
        Route::get('/participants-per-event', [AnalyticsController::class, 'participantsPerEvent']);
        Route::get('/most-popular-event', [AnalyticsController::class, 'mostPopularEvent']);
        Route::get('/total-registrations', [AnalyticsController::class, 'totalRegistrations']);
    });
});
