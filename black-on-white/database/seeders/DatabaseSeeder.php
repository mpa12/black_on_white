<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Participant;
use App\Models\PhotoGallery;
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
        Participant::factory(50)->create();
        PhotoGallery::factory(50)->create();
        Comment::factory(100)->create();
    }
}
