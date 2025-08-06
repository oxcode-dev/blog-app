<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => $this->author,
            "description" => $this->description,
            "url" => $this->url,
            "image" => $this->image,
            "category_id" => $this->category_id,
            "source" => $this->source,
            "comments" => $this->comments,
            "category" => $this->category,
            "posted_date" => $this->created_at,
        ];
    }
}
