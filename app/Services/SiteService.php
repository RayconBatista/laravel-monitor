<?php

namespace App\Services;


class SiteService
{
    public function store($inputs)
    {
        $user = auth()->user();
        $inputs['status'] = true;

        $site = $user?->sites()->create($inputs);

        if ($site) {
            $site->endpoints()->create(['endpoint' => '/', 'frequency' => 2]);
        }

        return redirect()
            ->route('sites.index')
            ->with('message', 'Site Criado com sucesso');
    }

    public function update($inputs, $site)
    {
        $site->update($inputs);
        return redirect()
            ->route('sites.index')
            ->with('message', 'Site Alterado com sucesso');
    }
}
