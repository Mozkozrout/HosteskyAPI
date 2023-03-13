<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this -> id,
            'attributes' => [
                'name' => $this -> name,
                'headline' => $this -> headline,
                'text' => $this -> text,
                'location' => $this -> location,
                'picture' => base_convert($this -> picture, 2, 2),
                'created_at' => $this -> created_at,
                'edited_at' => $this -> edited_at
            ],
            'relationships' => [
                'id' => (string) $this -> user -> id,
                'user name' => $this -> user -> name,
                'user surname' => $this -> user -> surname,
                'user email' => $this -> user -> email
            ]
        ];
    }
}
