<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\EventListener\LocaleListener;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locals = Local::all();
        $modalData = $this->addLocalModalData();

        return view('pages.actions.locals.locals', [
            'locals' => $locals,
            'regions' => $modalData['regions'],
            'districts' => $modalData['districts'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:255',
            'coordinates' => 'nullable|string|max:45',
            'type' => ['nullable', 'string', 'max:45', Rule::in(Local::LOCALTYPES)],
            'districts_id' => 'required|exists:districts,id',
            'regions_id' => 'required|exists:regions,id',
        ]);

        $local = new Local();
        $local->name = $validated['name'];
        $local->description = $validated['description'];
        $local->coordinates = $validated['coordinates'];
        $local->type = $validated['type'];
        $local->districts_id = $validated['districts_id'];
        $local->regions_id = $validated['regions_id'];

        $local->save();

        return redirect()->route('locals.index')->with('success', 'Local adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $districts = District::all();
        $regions = Region::all();

        return view('locals.edit', [
            'local' => $local,
            'districts' => $districts,
            'regions' => $regions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:255',
            'coordinates' => 'nullable|string|max:45',
            'type' => ['nullable', 'string', 'max:45', Rule::in(Local::LOCALTYPES)],
            'districts_id' => 'required|exists:districts,id',
            'regions_id' => 'required|exists:regions,id',
        ]);

        $local->update($validated);

        $local->save();

        return redirect()->route('locals.index')->with('success', 'Local atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return redirect()->route('locals.index')->with('success', 'Local deleted successfully!');
    }

    public function addLocalModalData()
    {
        $regions = Region::all();
        $districts = District::all();

        return [
            'regions' => $regions,
            'districts' => $districts,
        ];
    }
}
