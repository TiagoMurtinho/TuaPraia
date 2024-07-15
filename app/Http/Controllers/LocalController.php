<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
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
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $attributes = Attribute::all();
        $locals = Local::with('media')->paginate(5);
        $modalData = $this->addLocalModalData();

        return view('pages.actions.locals.locals', [
            'locals' => $locals,
            'attributes' => $attributes,
            'regions' => $modalData['regions'],
            'districts' => $modalData['districts'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $attributes = Attribute::all();
        $districts = District::all();
        $regions = Region::all();

        return view('pages.actions.locals.locals', [
            'attributes' => $attributes,
            'districts' => $districts,
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'coordinates' => 'required|string',
            'type' => 'required|string',
            'districts_id' => 'required|integer',
            'regions_id' => 'required|integer',
            'attributes' => 'array',
            'attributes.*' => 'integer|exists:attributes,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $local = Local::create($request->all());

        if ($request->hasFile('media')) {
            $local->addMediaFromRequest('media')->toMediaCollection('locals');
        }

        if ($request->has('attributes')) {
            $local->attributes()->attach($request->input('attributes'));
        }

        return redirect()->route('locals.index')->with('success', 'Local created successfully!');
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
        $attributes = Attribute::all();
        $districts = District::all();
        $regions = Region::all();

        return view('locals.edit', [
            'local' => $local,
            'districts' => $districts,
            'regions' => $regions,
            'attributes' => $attributes,
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
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'attributes' => 'array',
            'attributes.*' => 'integer|exists:attributes,id',
        ]);

        $local->update($validated);

        if ($request->hasFile('media')) {
            $local->clearMediaCollection('locals');
            $local->addMediaFromRequest('media')->toMediaCollection('locals');
        }

        $local->attributes()->sync($request->input('attributes', []));

        $local->save();

        return redirect()->route('locals.index')->with('success', 'Local updated successfully!');
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
