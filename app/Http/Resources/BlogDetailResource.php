<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BlogDetailResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'image' => $this->file_path,
            'author' => $this->user->name,
            'date_publish' => $this->created_at->toDayDateTimeString(),
            'body' => $this->body,
            'body_limit' => Str::limit($this->body, 200),
            'tags' => $this->tags,
            'category' => $this->category->name,
        ];
    }
}
