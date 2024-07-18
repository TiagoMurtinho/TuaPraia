<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Local;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::with('region')->get(); //Uses eager loading that loads all related classes on a same query
        $regions = Region::all();
        return view('pages.actions.districts.districts', compact('districts', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('pages.actions.districts.modals.add-districts', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'regions_id' => 'required|exists:regions,id'
        ]);

        $district = new District();
        $district->name = $validated['name'];
        $district->regions_id = $validated['regions_id'];

        $district->save();

        return redirect()->route('districts.index')->with('success', 'Attribute added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $districts = District::with('region')->findOrFail($id);
        $cascades = Local::where('districts_id', $id)->where('type', 'cascade')->get();
        $fluvials = Local::where('districts_id', $id)->where('type', 'fluvial')->get();
        $beaches = Local::where('districts_id', $id)->where('type', 'beach')->get();

        return view('pages.views.districts.districts', [
            'district' => $districts,
            'cascades' => $cascades,
            'fluvials' => $fluvials,
            'beaches' => $beaches
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'regions_id' => 'required|exists:regions,id'
        ]);

        $district = District::findorfail($id);
        $district->name = $validated['name'];
        $district->regions_id = $validated['regions_id'];
        $district->save();
        return redirect()->route('districts.index')->with('success', 'Distrit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district):RedirectResponse
    {
        $district->delete();

        return redirect()->route('districts.index')->with('success', 'District deleted successfully!');
    }
}
