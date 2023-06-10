<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sites = Site::with('endpoints')->get();
        $resource = SiteResource::collection($sites);

        $offline = null;
        $online = null;
        $resource->each(function ($item) use (&$offline, &$online) {
            $data = $item->endpoints()->with('checks')->get();
            $endpoints = EndpointResource::collection($data);

            $endpoints->each(function ($endpoint) use (&$offline) {
                $offline = $endpoint->checks->whereIn('status_code', [404, 500])->count();
            });

            $endpoints->each(function ($endpoint) use (&$online) {
                $online = $endpoint->checks->whereIn('status_code', [200])->count();
            });
        });
        
        return view('dashboard', [
            'sites' => $resource->count(),
            'online' => $online,
            'offline' => $offline
        ]);
    }
}
