<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $table = 'article_type';

    public $timestamps = false;

    public $fillable = [
        'title',
    ];
}
