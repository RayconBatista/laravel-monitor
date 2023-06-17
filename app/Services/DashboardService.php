<?php

namespace App\Services;

use App\Http\Resources\EndpointResource;

class DashboardService
{
    public function dashboard($resource, $points, $offline, $online)
    {

        $resource->each(function ($item) use (&$offline, &$online) {
            $data = $item->endpoints()->with('checks')->get();
            $endpoints = EndpointResource::collection($data);

            $endpoints->each(function ($endpoint) use (&$offline) {
                $offline = $endpoint->checks->whereIn('status_code', [404, 500, 0])->count();
            });

            $endpoints->each(function ($endpoint) use (&$online) {
                $online = $endpoint->checks->whereIn('status_code', [200])->count();
            });
        });

        return view('dashboard', [
            'sites' => $resource->count(),
            'endpoints' => $points->count(),
            'online' => $online,
            'offline' => $offline
        ]);
    }
}
