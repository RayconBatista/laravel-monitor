<?php

namespace App\Http\Resources;

use App\Models\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'url' => $this->url,
            'user' => $this->user,
            'status' => $this->status,
            'endpoints' => EndpointResource::collection($this->endpoints) 
        ];
    }
}
