<?php

namespace Database\Factories;

use Exception;

class ArticleFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_RU');

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
