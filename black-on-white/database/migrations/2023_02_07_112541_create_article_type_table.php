<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_type', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
        });

        DB::table('article_type')->insert(['title' => 'Новость']);
        DB::table('article_type')->insert(['title' => 'Спектакль']);
        DB::table('article_type')->insert(['title' => 'Сценарий']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_type');
    }
};
