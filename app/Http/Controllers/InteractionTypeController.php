<?php

namespace App\Http\Controllers;

use App\Models\InteractionType;
use Illuminate\Http\Request;

class InteractionTypeController extends Controller
{
    public function index()
    {
        $interactionTypes = InteractionType::all();
        return view('interaction_types.index', compact('interactionTypes'));
    }

    public function create()
    {
        return view('interaction_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:interaction_types,name',
        ]);

        InteractionType::create($request->only('name'));

        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação criado com sucesso.');
    }

    public function edit(InteractionType $interactionType)
    {
        return view('interaction_types.edit', compact('interactionType'));
    }

    public function update(Request $request, InteractionType $interactionType)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:interaction_types,name,' . $interactionType->id,
        ]);

        $interactionType->update($request->only('name'));

        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação atualizado com sucesso.');
    }

    public function destroy(InteractionType $interactionType)
    {
        $interactionType->delete();
        return redirect()->route('interaction-types.index')->with('success', 'Tipo de interação excluído com sucesso.');
    }
}
