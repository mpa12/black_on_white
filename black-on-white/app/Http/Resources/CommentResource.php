<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'article_id' => $this->article_id,
            'user' => ['name' => $this->user->name],
            'body' => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'parent_id' => $this->parent_id,
            'can_delete' => $this->canDelete(),
        ];
    }
}
