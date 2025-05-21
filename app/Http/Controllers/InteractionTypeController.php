<?php

namespace App\Http\Controllers;

use App\Models\InteractionType;
use Illuminate\Http\Request;

class InteractionTypeController extends Controller
{
    public function index()
    {
        // Exibe todos os tipos de interação
        $interactionTypes = InteractionType::all();
        return view('interaction_types.index', compact('interactionTypes'));
    }

    public function create()
    {
        // Exibe o formulário para criar um novo tipo de interação
        return view('interaction_types.create');
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário e cria um novo tipo de interação
        $request->validate([
            'name' => 'required|string|max:100|unique:interaction_types,name',
        ], [
            'name.required' => 'O nome do tipo de interação é obrigatório.',
            'name.unique' => 'Já existe um tipo de interação com esse nome.',
            'name.max' => 'O nome do tipo de interação deve ter no máximo 100 caracteres.',
        ]);

        InteractionType::create([
            'name' => $request->name
        ]);

        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação criado com sucesso!');
    }

    public function edit(InteractionType $interactionType)
    {
        // Exibe o formulário para editar um tipo de interação
        return view('interaction_types.edit', compact('interactionType'));
    }

    public function update(Request $request, InteractionType $interactionType)
    {
        // Valida os dados e atualiza o tipo de interação
        $request->validate([
            'name' => 'required|string|max:100|unique:interaction_types,name,' . $interactionType->id,
        ], [
            'name.required' => 'O nome do tipo de interação é obrigatório.',
            'name.unique' => 'Já existe um tipo de interação com esse nome.',
            'name.max' => 'O nome do tipo de interação deve ter no máximo 100 caracteres.',
        ]);

        $interactionType->update([
            'name' => $request->name
        ]);

        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação atualizado com sucesso!');
    }

    public function destroy(InteractionType $interactionType)
    {
        // Exclui o tipo de interação
        $interactionType->delete();

        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação excluído com sucesso!');
    }
}
