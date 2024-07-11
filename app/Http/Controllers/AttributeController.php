<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttributeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('pages.actions.attributes.attributes', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45'
        ]);

        $attribute = new Attribute();
        $attribute->name = $validated['name'];

        $attribute->save();

        return redirect()->route('attributes.index')->with('success', 'Attribute added successfully!');
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
    public function edit(int $id)
    {
        return view('pages.actions.attributes.modals.edit-attributes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:45'
        ]);

        $attribute = Attribute::findorfail($id);
        $attribute->name = $validated['name'];
        $attribute->save();
        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute):RedirectResponse
    {

        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully!');
    }
}
