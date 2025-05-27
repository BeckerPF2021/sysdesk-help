@extends('layouts.app')

@section('title', 'Criar Novo Status de Ticket')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Criar Novo Status de Ticket</h5>
                </div>
                <div class="card-body">

                    {{-- Mensagem de erro --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulário de criação --}}
                    <form action="{{ route('ticket-statuses.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nome do Status</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg"
                                   placeholder="Ex: Em andamento" required>
                        </div>

                        <div class="d-flex justify-content-start gap-3 mt-4">
                            <button type="submit" class="btn btn-success px-4 font-weight-bold">
                                Criar Status
                            </button>
                            <a href="{{ route('ticket-statuses.index') }}" class="btn btn-secondary px-4 font-weight-bold">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
