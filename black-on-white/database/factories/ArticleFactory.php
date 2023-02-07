<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create('ru_RU');

        return [
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
            'title' => $faker->realText(25),
            'description' => $faker->realText(128),
            'text' => $faker->realText(1024),
            'photo' => $faker->imageUrl,
            'article_type_id' => random_int(1, 2),
        ];
    }
}
