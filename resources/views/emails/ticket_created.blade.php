<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Ticket Atribuído</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;">
    <table style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="text-align: center; padding-bottom: 20px;">
                <h2 style="color: #333;">🎫 Novo Ticket Atribuído a Você</h2>
                <p style="color: #666; font-size: 14px;">Um novo chamado foi registrado no sistema e atribuído à sua responsabilidade.</p>
            </td>
        </tr>

        <tr>
            <td>
                <table width="100%" style="font-size: 14px; color: #333;">
                    <tr>
                        <td style="padding: 8px 0;"><strong>Título:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->title }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Descrição:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->description }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Solicitante:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Categoria:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->category->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Status:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->ticketStatus->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Prioridade:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->ticketPriority->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Departamento:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->department->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Data de Criação:</strong></td>
                        <td style="padding: 8px 0;">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="text-align: center; padding-top: 30px;">
                <a href="{{ route('tickets.show', $ticket->id) }}" style="display: inline-block; background-color: #007BFF; color: #fff; padding: 12px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Ver Ticket
                </a>
            </td>
        </tr>

        <tr>
            <td style="text-align: center; font-size: 12px; color: #999; padding-top: 30px;">
                <p>Esta é uma mensagem automática do sistema SysDesk.</p>
            </td>
        </tr>
    </table>
</body>
</html>
