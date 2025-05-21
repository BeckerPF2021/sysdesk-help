@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📈 Relatórios de Chamados</h2>

    <div class="row">
        <!-- Cards resumo -->
        <div class="col-md-3">
            <div class="mb-3 shadow-sm card">
                <div class="text-center card-body">
                    <h5>Chamados Hoje</h5>
                    <h2>{{ $ticketsToday }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3 shadow-sm card">
                <div class="text-center card-body">
                    <h5>Chamados no Mês</h5>
                    <h2>{{ $ticketsMonth }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3 shadow-sm card">
                <div class="text-center card-body">
                    <h5>Chamados no Ano</h5>
                    <h2>{{ $ticketsYear }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3 shadow-sm card">
                <div class="text-center card-body">
                    <h5>Resolvidos Hoje</h5>
                    <h2>{{ $resolvedToday }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão para PDF -->
    <div class="mb-4">
        <a href="{{ route('reports.pdf') }}" target="_blank" class="btn btn-danger">
            📄 Gerar Relatório em PDF
        </a>
    </div>

    <!-- Chamados por Responsável -->
    <h4>📋 Chamados por Responsável</h4>
    <table class="table mt-2 table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Responsável</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByUser as $item)
                <tr>
                    <td>{{ $item->responsibleUser->name ?? 'Não atribuído' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Chamados por Status -->
    <h4 class="mt-5">🚦 Chamados por Status</h4>
    <table class="table mt-2 table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Status</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByStatus as $item)
                <tr>
                    <td>{{ $item->ticketStatus->name ?? 'Sem Status' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Chamados por Prioridade -->
    <h4 class="mt-5">⚠️ Chamados por Prioridade</h4>
    <table class="table mt-2 table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Prioridade</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByPriority as $item)
                <tr>
                    <td>{{ $item->ticketPriority->name ?? 'Sem Prioridade' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Chamados por Categoria -->
    <h4 class="mt-5">📂 Chamados por Categoria</h4>
    <table class="table mt-2 mb-5 table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Categoria</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByCategory as $item)
                <tr>
                    <td>{{ $item->category->name ?? 'Sem Categoria' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
