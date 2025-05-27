<?php

namespace App\Mail;

use App\Models\TicketInteraction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketInteractionMail extends Mailable
{
    use Queueable, SerializesModels;

    public TicketInteraction $interaction;

    public function __construct(TicketInteraction $interaction)
    {
        $this->interaction = $interaction->load(['user', 'ticket', 'interactionType']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova Interação em Ticket #' . $this->interaction->ticket->id
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_interaction',
            with: [
                'interaction' => $this->interaction,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
