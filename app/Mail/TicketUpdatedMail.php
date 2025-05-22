<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;
    public int $oldStatusId;
    public int $oldPriorityId;

    public function __construct(Ticket $ticket, int $oldStatusId, int $oldPriorityId)
    {
        $this->ticket = $ticket;
        $this->oldStatusId = $oldStatusId;
        $this->oldPriorityId = $oldPriorityId;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Atualizado - Mudança de Status ou Prioridade'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_updated',
            with: [
                'ticket' => $this->ticket,
                'oldStatusId' => $this->oldStatusId,
                'oldPriorityId' => $this->oldPriorityId,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
