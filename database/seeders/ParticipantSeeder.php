<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use App\Models\Participant;
use App\Models\Events;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $events = Events::all();

    foreach ($events as $event) {
        Participant::factory()
            ->count(4)
            ->create([
                'event_id' => $event->id,
            ]);
        }
    }
}
