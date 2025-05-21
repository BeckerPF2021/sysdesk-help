<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    // Função index para listar os grupos de usuários com paginação
    public function index()
    {
        // Paginando os resultados para exibir 10 grupos por página
        $userGroups = UserGroup::paginate(10);
        return view('user_groups.index', compact('userGroups'));
    }

    // Função para exibir o formulário de criação
    public function create()
    {
        return view('user_groups.create');
    }

    // Função para armazenar um novo grupo de usuário
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'name' => 'required|unique:user_groups,name',
            'description' => 'nullable',
        ]);

        // Criando o grupo de usuário
        UserGroup::create($request->all());
        return redirect()->route('user-groups.index')->with('success', 'Grupo criado com sucesso.');
    }

    // Função para exibir o formulário de edição
    public function edit(UserGroup $userGroup)
    {
        return view('user_groups.edit', compact('userGroup'));
    }

    // Função para atualizar um grupo de usuário
    public function update(Request $request, UserGroup $userGroup)
    {
        // Validação dos campos
        $request->validate([
            'name' => 'required|unique:user_groups,name,' . $userGroup->id,
            'description' => 'nullable',
        ]);

        // Atualizando o grupo de usuário
        $userGroup->update($request->all());
        return redirect()->route('user-groups.index')->with('success', 'Grupo atualizado com sucesso.');
    }

    // Função para excluir um grupo de usuário
    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();
        return redirect()->route('user-groups.index')->with('success', 'Grupo excluído com sucesso.');
    }
}
