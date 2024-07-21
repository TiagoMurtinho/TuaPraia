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
        $attributes = Attribute::all(); // Obtém todos os atributos do model "Attribute".
        $locals = Local::with('media')->paginate(5); // Obtém todos os locals com as suas respectivas medias e paginação.
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

        $local = Local::create($request->all()); // Cria um novo registro de 'Local' com os dados validados da requisição.

        if ($request->hasFile('media')) {
            $local->addMediaFromRequest('media')->toMediaCollection('locals'); // Adiciona o arquivo de mídia à coleção 'locals'.
        }

        if ($request->has('attributes')) {
            $local->attributes()->attach($request->input('attributes'));  // Anexa os atributos ao novo local.
        }

        return redirect()->route('locals.index')->with('success', 'Local created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {

        $local = Local::with('district')->findOrFail($id);

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

        /*
           Sincroniza os atributos associados ao local com os IDs fornecidos na requisição.
           O método 'attributes()' retorna a relação muitos para muitos entre 'Local' e 'Attribute'.
           O método 'sync()' atualiza a relação, removendo atributos que não estão na entrada e adicionando novos que estão presentes.
           Se nenhum atributo for fornecido, um array vazio é passado, removendo todos os atributos existentes.
        */

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
