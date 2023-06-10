<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site' => SiteResource::make($this->site),
            'checks' => CheckResource::collection($this->checks),
            'endpoint' => $this->endpoint, 
            'frequency' => $this->frequency, 
            'next_check' => $this->next_check
        ];
    }
}
