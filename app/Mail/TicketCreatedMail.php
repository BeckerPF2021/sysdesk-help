<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;

    /**
     * Cria uma nova instância do e-mail.
     */
    public function __construct(Ticket $ticket)
    {
        // Garante que todas as relações sejam carregadas
        $this->ticket = $ticket->load([
            'user',
            'responsibleUser',
            'category',
            'ticketStatus',
            'ticketPriority',
            'department'
        ]);
    }

    /**
     * Define o envelope do e-mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo Ticket Atribuído a Você'
        );
    }

    /**
     * Define o conteúdo do e-mail.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_created',
            with: [
                'ticket' => $this->ticket
            ]
        );
    }

    /**
     * Anexos (opcional).
     */
    public function attachments(): array
    {
        return [];
    }
}