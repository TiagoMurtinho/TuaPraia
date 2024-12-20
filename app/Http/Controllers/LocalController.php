<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Local;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\EventListener\LocaleListener;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $attributes = Attribute::all(); // Obtém todos os atributos do model "Attribute".
        $locals = Local::with('media')->orderBy('id', 'desc')->paginate(5); // Obtém todos os locals com as suas respectivas medias e paginação.
        $modalData = $this->addLocalModalData();

        return view('pages.actions.locals.locals', [
            'locals' => $locals, // Passa a lista de locais para a view
            'attributes' => $attributes, // Passa os atributos para a view
            'regions' => $modalData['regions'], // Passa as regiões obtidas no modal
            'districts' => $modalData['districts'], // Passa os distritos obtidos no modal
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
    public function store(Request $request): JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'coordinates' => 'required|string|max:255',
            'type' => 'required|string',
            'districts_id' => 'required|exists:districts,id',
            'regions_id' => 'required|exists:regions,id',
            'attributes' => 'nullable|array',
            'attributes.*' => 'integer|exists:attributes,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray() // Retorna os erros de validação
            ], 422);
        }

        // Criação do novo local
        $local = new Local();
        $local->name = $request->input('name');
        $local->description = $request->input('description');
        $local->coordinates = $request->input('coordinates');
        $local->type = $request->input('type');
        $local->districts_id = $request->input('districts_id');
        $local->regions_id = $request->input('regions_id');
        $local->save();

        // Adição de mídia, se fornecida
        if ($request->hasFile('media')) {
            $local->addMediaFromRequest('media')->toMediaCollection('locals');
        }

        // Associação de atributos, se fornecidos
        if ($request->has('attributes')) {
            $local->attributes()->attach($request->input('attributes'));
        }

        // Retorna uma resposta de sucesso com uma URL de redirecionamento
        return response()->json([
            'success' => true,
            'redirect' => route('locals.index'). '?message_key=local_inserted'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {

        $local = Local::with('district', 'attributes')->findOrFail($id);

        $coordinates = explode(',', $local->coordinates);

        if (count($coordinates) == 2) {
            $latitude = trim($coordinates[0]);
            $longitude = trim($coordinates[1]);
        } else {
            $latitude = null;
            $longitude = null;
        }

        return view('pages.views.locals.local', compact('local', 'latitude', 'longitude'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $attributes = Attribute::all();
        $districts = District::all();
        $regions = Region::all();

        return view('pages.actions.locals.locals', [
            'local' => $local,
            'districts' => $districts,
            'regions' => $regions,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local): JsonResponse
    {
        // Valida os dados recebidos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'coordinates' => 'nullable|string|max:255',
            'type' => ['nullable', 'string', 'max:255', Rule::in(Local::LOCALTYPES)],
            'districts_id' => 'required|exists:districts,id',
            'regions_id' => 'required|exists:regions,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'attributes' => 'nullable|array',
            'attributes.*' => 'integer|exists:attributes,id',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualiza o local com os dados validados
        $local->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'coordinates' => $request->input('coordinates'),
            'type' => $request->input('type'),
            'districts_id' => $request->input('districts_id'),
            'regions_id' => $request->input('regions_id'),
        ]);

        // Se um novo arquivo de mídia foi enviado, substitua o anterior
        if ($request->hasFile('media')) {
            try {
                // Limpa a coleção de mídia anterior
                $local->clearMediaCollection('locals');
                // Adiciona o novo arquivo de mídia
                $local->addMediaFromRequest('media')->toMediaCollection('locals');
            } catch (\Exception $e) {
                // Retorna um erro se a mídia não puder ser processada
                return response()->json([
                    'message' => 'Falha ao adicionar mídia: ' . $e->getMessage()
                ], 500);
            }
        }

        // Sincroniza os atributos associados ao local
        $local->attributes()->sync($request->input('attributes', []));

        // Retorna uma resposta JSON com sucesso
        return response()->json([
            'success' => true,
            'redirect' => route('locals.index') . '?message_key=local_changed'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local): JsonResponse
    {
        $local->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('locals.index') . '?message_key=local_deleted'
        ]);
    }

    public function addLocalModalData(): array
    {
        $regions = Region::all(); // Obtém todas as regiões do banco de dados.
        $districts = District::all(); // Obtém todos os distritos do banco de dados.

        /*
            Retorna um array associativo com as regiões e distritos.
        */
        return [
            'regions' => $regions,
            'districts' => $districts,
        ];
    }

}
