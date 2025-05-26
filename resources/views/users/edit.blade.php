@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Editar Usuário</h5>
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

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">E-mail</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                        </div>

                        <div class="form-group mt-3">
                            <label for="user_group_id">Grupo de Usuário</label>
                            <select
                                name="user_group_id"
                                id="user_group_id"
                                class="form-control"
                            >
                                <option value="">— Selecione um grupo —</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ $user->user_group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">

                        <div class="form-group">
                            <label for="password">Nova Senha <small class="text-muted">(opcional)</small></label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Deixe em branco para manter a senha atual"
                            >
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirmar Nova Senha</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                            >
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
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
