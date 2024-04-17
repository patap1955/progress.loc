<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "url" => $this->url,
            "title" => $this->title,
            "subject" => $this->subject,
            "body" => $this->body,
            "sender" => $this->sender,
            "status" => $this->status,
            "created_at" => $this->created_at,
        ];
    }
}
