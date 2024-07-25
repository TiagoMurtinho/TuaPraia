<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(): View
    {
        $regions = Region::all();

        return view('pages.actions.regions.regions', [
            'regions' => $regions
        ]);
    }

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $region = Region::with('districts.locals')->findOrFail($id);

        return view('pages.views.regions.regions', compact('region'));
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45', // Ajuste o tamanho máximo conforme necessário
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Lógica para salvar a nova região
        $region = new Region();
        $region->name = $request->input('name');
        $region->save();

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('regions.index'), // Ajuste a rota conforme necessário
            'message' => 'Região adicionada com sucesso!'
        ]);
    }

    public function edit(string $id)
    {
        $region = Region::findOrFail($id);

        return view('pages.actions.regions.regions-edit-modal', [
            'region' => $region
        ]);
    }

    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45', // Ajuste o tamanho máximo conforme necessário
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Encontra a região e atualiza o nome
        $region = Region::findOrFail($id);
        $region->name = $request->input('name');
        $region->save();

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('regions.index'), // Ajuste a rota conforme necessário
            'message' => 'Região atualizada com sucesso!'
        ]);
    }

    public function destroy(Region $region):RedirectResponse
    {
        $region->delete();

        return redirect(route('regions.index'))->with('success', 'Região excluída com sucesso!');
    }

}
