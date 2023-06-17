<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use App\Models\{Site, Endpoint};
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        public DashboardService $dashboardService
    ) {}

    public function index()
    {
        $sites = Site::get();
        $endpoints = Endpoint::get();
        $resource = SiteResource::collection($sites);

        $offline = 0;
        $online = 0;

        return $this->dashboardService->dashboard($resource, $endpoints, $offline, $online);
    }
}
