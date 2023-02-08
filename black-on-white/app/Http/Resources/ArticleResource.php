<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'title' => $this->title,
            'description' => $this->description,
            'text' => $this->text,
            'photo' => $this->photo,
            'article_type' => $this->articleType,
        ];
    }
}
