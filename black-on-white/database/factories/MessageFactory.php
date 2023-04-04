<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'message' => $faker->realText(128),
            'is_read' => false
        ];
    }
}
