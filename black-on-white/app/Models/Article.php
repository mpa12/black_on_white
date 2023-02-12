<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function articleType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\ArticleType', 'id', 'article_type_id');
    }
}
