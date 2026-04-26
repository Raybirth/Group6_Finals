<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Events;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @extends Factory<Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'event_id' => null,
        'participant_name' => $this->faker->name(),
        ];
    }
}
