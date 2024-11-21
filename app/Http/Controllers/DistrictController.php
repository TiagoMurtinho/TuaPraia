<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Local;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $regions = Region::all();
        $districts = District::with('region')->paginate(5);
        return view('pages.actions.districts.districts', compact('districts', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $regions = Region::all();
        return view('pages.actions.districts.modals.add-districts', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
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
            'redirect' => route('districts.index') . '?message_key=district_inserted'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $district = District::with('region')->findOrFail($id);

        $filters = $request->input('filters', []);
        $query = $request->input('query', '');

        $localsQuery = Local::query()
            ->where('districts_id', $id)
            ->where('name', 'LIKE', '%' . $query . '%');

        if (!empty($filters)) {
            $localsQuery->whereHas('attributes', function ($query) use ($filters) {
                $query->whereIn('name', $filters);
            }, '=', count($filters));
        }

        $locals = $localsQuery->distinct()->get();

        return view('pages.views.districts.districts', [
            'district' => $district,
            'locals' => $locals,
            'filters' => $filters,
            'query' => $query
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
    public function update(Request $request, District $district): JsonResponse
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
            'redirect' => route('districts.index') . '?message_key=district_changed'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district): JsonResponse
    {
        $district->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('districts.index') . '?message_key=district_deleted'
        ]);
    }
}
