<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Route;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'short_content' => $this->short_content,
            'body' => $this->when(Route::currentRouteName() === 'posts.show', $this->body),
            'image' => $this->image,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
