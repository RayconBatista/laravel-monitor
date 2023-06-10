<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Endpoint;

class CheckerController extends Controller
{
    public function index(Endpoint $endpoint)
    {
        $checks = $endpoint->checks()->paginate();

        return view('admin.endpoints.logs.index', compact('endpoint', 'checks'));
    }
}