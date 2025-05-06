<?php
namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        $userGroups = UserGroup::all();
        return view('user_groups.index', compact('userGroups'));
    }

    public function create()
    {
        return view('user_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:user_groups,name',
            'description' => 'nullable',
        ]);

        UserGroup::create($request->all());
        return redirect()->route('user-groups.index')->with('success', 'Grupo criado com sucesso.');
    }

    public function edit(UserGroup $userGroup)
    {
        return view('user_groups.edit', compact('userGroup'));
    }

    public function update(Request $request, UserGroup $userGroup)
    {
        $request->validate([
            'name' => 'required|unique:user_groups,name,' . $userGroup->id,
            'description' => 'nullable',
        ]);

        $userGroup->update($request->all());
        return redirect()->route('user-groups.index')->with('success', 'Grupo atualizado com sucesso.');
    }

    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();
        return redirect()->route('user-groups.index')->with('success', 'Grupo excluído com sucesso.');
    }
}