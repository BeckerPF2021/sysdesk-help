<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // Obtém todos os departamentos
        return view('departments.index', compact('departments')); // Retorna a view com os departamentos
    }

    public function create()
    {
        return view('departments.create'); // Retorna a view para criar um novo departamento
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:departments,name', // Validação
        ]);

        Department::create($request->all()); // Cria um novo departamento

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department')); // Retorna a view para editar um departamento
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:departments,name,' . $department->id,
        ]);

        $department->update($request->all()); // Atualiza o departamento

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete(); // Deleta o departamento

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}