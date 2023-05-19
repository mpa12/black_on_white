<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        'article_id',
        'user_id',
        'body',
        'parent_id',
    ];

    public function article(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Article', 'id', 'article_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function canDelete(): bool
    {
        $auth = Auth::guard('api');
        if (is_null($auth->user())) return false;
        return $auth->id() === $this->user_id || $auth->user()['is_admin'];
    }
}
