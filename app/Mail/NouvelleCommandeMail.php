<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleCommandeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $stand;

    /**
     * Create a new message instance.
     */
    public function __construct($commande, $stand)
    {
        $this->commande = $commande;
        $this->stand = $stand;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle Commande Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.nouvelle_commande',
        );
    }

    public function build()
    {
        return $this->markdown('emails.nouvelle_commande')
            ->subject('Nouvelle commande sur votre stand')
            ->with([
                'commande' => $this->commande,
                'stand' => $this->stand,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
