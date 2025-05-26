@extends('layouts.app')

@section('title', 'Editar Status de Ticket')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Editar Status de Ticket</h5>
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

                    {{-- Formulário de edição --}}
                    <form action="{{ route('ticket-statuses.update', $ticketStatus->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nome do Status</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg"
                                   value="{{ old('name', $ticketStatus->name) }}" required>
                        </div>

                        <div class="d-flex justify-content-start gap-3 mt-4">
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                Atualizar
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
