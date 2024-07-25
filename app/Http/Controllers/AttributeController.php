<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Lógica para salvar o atributo
        $attribute = new Attribute();
        $attribute->name = $request->input('name');
        $attribute->save();


        // Retorna uma resposta de sucesso
        return response()->json([
            'success' => true,
            'redirect' => route('attributes.index') // Ajuste a rota conforme necessário
        ]);
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
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        // Valida os dados recebidos
        $validated = $request->validate([
            'name' => 'required|string|max:45'
        ]);

        // Encontra o atributo pelo ID ou retorna erro se não encontrar
        $attribute = Attribute::findOrFail($id);

        // Atualiza o atributo
        $attribute->name = $validated['name'];
        $attribute->save();

        // Retorna uma resposta JSON para o AJAX
        return response()->json([
            'success' => true,
            'redirect' => route('attributes.index') // Redireciona para a lista de atributos após a atualização
        ]);
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
