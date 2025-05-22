<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Chamados</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h4 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Relatório de Chamados</h2>
    <p style="text-align:center; font-size:10px; color:#555;">Gerado em: {{ $generatedAt }}</p>

    <p><strong>Chamados Hoje:</strong> {{ $ticketsToday }}</p>
    <p><strong>Chamados no Mês:</strong> {{ $ticketsMonth }}</p>
    <p><strong>Chamados no Ano:</strong> {{ $ticketsYear }}</p>
    <p><strong>Chamados Resolvidos Hoje:</strong> {{ $resolvedToday }}</p>

    <h4>Chamados por Responsável</h4>
    <table>
        <thead>
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

    <h4>Chamados por Status</h4>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByStatus as $item)
                <tr>
                    <td>{{ $item->ticketStatus->name ?? 'Sem status' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Chamados por Prioridade</h4>
    <table>
        <thead>
            <tr>
                <th>Prioridade</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByPriority as $item)
                <tr>
                    <td>{{ $item->ticketPriority->name ?? 'Sem prioridade' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Chamados por Categoria</h4>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Total de Chamados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketsByCategory as $item)
                <tr>
                    <td>{{ $item->category->name ?? 'Sem categoria' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
