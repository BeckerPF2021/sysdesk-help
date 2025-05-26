@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Editar Grupo de Usuário</h5>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Erros encontrados:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user-groups.update', $userGroup->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nome do Grupo</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $userGroup->name) }}"
                                required
                            >
                        </div>

                        <div class="form-group mt-3">
                            <label for="description">Descrição <small class="text-muted">(opcional)</small></label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                rows="3"
                            >{{ old('description', $userGroup->description) }}</textarea>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('user-groups.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Atualizar
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection