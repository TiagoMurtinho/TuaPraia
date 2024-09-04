<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {

        $regions = Region::paginate(5);
        return view('pages.actions.regions.regions', compact('regions'));
    }

    public function show(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $region = Region::with('districts.locals')->findOrFail($id);

        $filters = $request->input('filters', []); // Obtém os filtros do request
        $query = $request->input('query', ''); // O termo de pesquisa

        // Aplicar filtros se houver
        $localsQuery = Local::query()
            ->where('regions_id', $id)
            ->where('name', 'LIKE', '%' . $query . '%');

        if (!empty($filters)) {
            $localsQuery->whereHas('attributes', function ($query) use ($filters) {
                $query->whereIn('name', $filters);
            }, '=', count($filters));
        }

        $locals = $localsQuery->distinct()->get();

        return view('pages.views.regions.regions', [
            'region' => $region,
            'regionId' => $id,
            'locals' => $locals, // Passa os locais filtrados para a view
            'filters' => $filters, // Passa os filtros para a view, se necessário
            'query' => $query
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray() // Retorna os erros de validação
            ], 422);
        }

        // Lógica para salvar a nova região
        $region = new Region();
        $region->name = $request->input('name');
        $region->save();

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('regions.index'),
            'message' => __('messages.region_added_successfully')
        ]);
    }

    public function edit(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
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
            'name' => 'required|string|max:45',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray() // Retorna os erros de validação
            ], 422);
        }

        // Encontra a região e atualiza o nome
        $region = Region::findOrFail($id);
        $region->name = $request->input('name');
        $region->save();

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('regions.index'),
            'message' => __('messages.region_updated_successfully') // Mensagem de sucesso localizada
        ]);
    }

    public function destroy(Region $region):RedirectResponse
    {
        $region->delete();

        return redirect(route('regions.index'))->with('success', 'Região excluída com sucesso!');
    }

}
