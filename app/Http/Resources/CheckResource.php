<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'endpoint' => EndpointResource::make($this->endpoint),
            'status_code' => $this->status_code, 
            'response_body' => $this->response_body
        ];
    }
}
