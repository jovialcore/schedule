<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'start_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_at' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'owner_id' => User::factory(),
            'max_num_of_participants' => 10,
        ];
    }


    public function withParticipants(int $count = 0)
    {
        return $this->afterCreating(function (Event $event) use ($count) {
            if ($count > 0) {
                $users = User::factory()->count($count)->create();
                $event->participants()->attach($users->pluck('id'));
            }
        });
    }

}
