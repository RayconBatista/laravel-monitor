<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateSiteRequest;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Services\SiteService;

class SiteController extends Controller
{
    public function __construct(public SiteService $siteService)
    {}
    public function index()
    {
        $sites = Site::with('user')->paginate();
        $data = SiteResource::collection($sites);
        
        return view('admin/sites/index', [
            'sites' => $data
        ]);
    }

    public function create()
    {
        return view('admin/sites/create');
    }

    public function store(StoreUpdateSiteRequest $request)
    {
        $inputs = $request->validated();
        return $this->siteService->store($inputs);
    }

    public function edit(Site $site)
    {
        if (!$site) {
            return back();
        }

        return view('admin/sites/edit', compact('site'));
    }

    public function update(StoreUpdateSiteRequest $request, Site $site)
    {
        $inputs = $request->validated();
        return $this->siteService->update($inputs, $site);
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return redirect()
                    ->route('sites.index')
                    ->with('message', 'Site Deletado com sucesso');;
    }
}
