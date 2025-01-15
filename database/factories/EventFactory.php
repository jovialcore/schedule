<?php

namespace Database\Factories;

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
            'event name ' => $this->faker->name,
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'owner_id' => $this->faker->numberBetween(1, 10),
            'max_num_of_participants' => $this->faker->numberBetween(1, 10),
        ];
    }
}
