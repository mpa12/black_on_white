<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'body' => $faker->realText(128),
            'article_id' => random_int(1, 50),
            'user_id' => 1,
        ];
    }
}
