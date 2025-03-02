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
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence(15),
            'content' => $this->faker->paragraphs(15, true),
            'start_date' => $startDate = $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'location' => $this->faker->streetAddress,
        ];
    }
}
