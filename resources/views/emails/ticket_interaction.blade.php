<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Interação no Ticket</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;">
    <table style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="text-align: center; padding-bottom: 20px;">
                <h2 style="color: #333;">💬 Nova Interação em um Ticket</h2>
                <p style="color: #666; font-size: 14px;">Uma nova atualização foi registrada no ticket #{{ $interaction->ticket->id }}.</p>
            </td>
        </tr>

        <tr>
            <td>
                <table width="100%" style="font-size: 14px; color: #333;">
                    <tr>
                        <td style="padding: 8px 0;"><strong>Usuário:</strong></td>
                        <td style="padding: 8px 0;">{{ $interaction->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Tipo de Interação:</strong></td>
                        <td style="padding: 8px 0;">{{ $interaction->interactionType->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Data:</strong></td>
                        <td style="padding: 8px 0;">{{ \Carbon\Carbon::parse($interaction->comment_date)->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; vertical-align: top;"><strong>Comentário:</strong></td>
                        <td style="padding: 8px 0;">{!! nl2br(e($interaction->text)) !!}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="text-align: center; padding-top: 30px;">
                <a href="{{ route('tickets.show', $interaction->ticket->id) }}" style="display: inline-block; background-color: #28a745; color: #fff; padding: 12px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
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
