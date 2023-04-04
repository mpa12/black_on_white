<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Article::factory(50)->create();
        Message::factory(50)->create();
    }
}
