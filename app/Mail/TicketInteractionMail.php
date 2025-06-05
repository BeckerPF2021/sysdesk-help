<?php

namespace App\Mail;

use App\Models\TicketInteraction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class TicketInteractionMail extends Mailable
{
    use Queueable, SerializesModels;

    public TicketInteraction $interaction;

    public function __construct(TicketInteraction $interaction)
    {
        // Já carrega relacionamentos para uso na view
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
        if ($this->interaction->file_path && Storage::disk('public')->exists($this->interaction->file_path)) {
            return [
                Attachment::fromStorageDisk('public', $this->interaction->file_path)
                    ->as(basename($this->interaction->file_path)),
            ];
        }

        return [];
    }
}