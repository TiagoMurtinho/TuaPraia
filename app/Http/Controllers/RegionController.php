<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionController extends Controller
{
    public function index(): View
    {
        $regions = Region::get();

        return view('pages.actions.regions.regions', [
            'regions' => $regions
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $region = new Region();
        $region->name = $validated['name'];

        $region->save();

        return redirect()->route('regions.index')->with('success', 'Região adicionada com sucesso!');

    }

    public function edit(string $id)
    {
        $region = Region::findOrFail($id);

        return view('pages.actions.regions.regions-edit-modal', [
            'region' => $region
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $region = Region::findOrFail($id);
        $region->name = $validated['name'];
        $region->save();

        return redirect()->route('regions.index')->with('success', 'Região atualizada com sucesso!');
    }

    public function destroy(Region $region):RedirectResponse
    {
        $region->delete();

        return redirect(route('regions.index'))->with('success', 'Região excluída com sucesso!');
    }

}
