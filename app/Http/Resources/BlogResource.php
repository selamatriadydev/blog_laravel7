<?php

namespace App\Http\Resources;

use App\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use App\Tag;
use App\Post;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return $request;
        return [
            'link' => $this->slug,
            'title' => $this->title,
            'image' => url($this->file_path),
            'author' => $this->user->name,
            'date_publish' => $this->created_at->toDayDateTimeString(), 
            'body' => $this->body,
            'body_limit' => Str::limit($this->body, 200),
            'tags' => $this->tags,
            'category' => $this->category->name,
            'comment_count' => $this->comments_count,
            'allCategory' => Category::pluck('name')->all(),
            'allTags' => Tag::pluck('name')->all(),
            'article' => Post::select('title', 'file_path')->orderBy('created_at', 'asc')->limit(5)->get()
        ];
    }
}
