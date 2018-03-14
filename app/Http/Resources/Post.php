<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user' => $this->name,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'tag' => $this->tag,
        ];
    }
}
