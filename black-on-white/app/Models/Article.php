<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'text',
        'photo',
        'article_type_id',
    ];

    public function articleType(): HasOne
    {
        return $this->hasOne('App\Models\ArticleType', 'id', 'article_type_id');
    }
}
