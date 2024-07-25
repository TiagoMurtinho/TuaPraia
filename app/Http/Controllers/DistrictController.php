<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Local;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'regions_id' => 'required|exists:regions,id'
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray()
            ], 422);
        }

        // Lógica para salvar o distrito
        $district = new District();
        $district->name = $request->input('name');
        $district->regions_id = $request->input('regions_id');
        $district->save();

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('districts.index'),
            'message' => __('messages.district_added_successfully') // Mensagem de sucesso localizada
        ]);
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
    public function update(Request $request, District $district): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'regions_id' => 'required|exists:regions,id',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray() // Retorna os erros de validação
            ], 422);
        }

        // Atualiza o distrito
        $district->name = $request->input('name');
        $district->regions_id = $request->input('regions_id');
        $district->save();

        // Retorna uma resposta de sucesso
        return response()->json([
            'success' => true,
            'redirect' => route('districts.index'),
            'message' => __('messages.district_updated_successfully') // Mensagem de sucesso localizada
        ]);
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
