<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Endpoint;
use Illuminate\Auth\Access\AuthorizationException;

class CheckerController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Endpoint $endpoint)
    {
        $this->authorize('ownerChecks', $endpoint);
        $checks = $endpoint->checks()->paginate();

        return view('admin.endpoints.logs.index', compact('endpoint', 'checks'));
    }
}
