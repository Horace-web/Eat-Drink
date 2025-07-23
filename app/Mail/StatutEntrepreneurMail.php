<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatutEntrepreneurMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $statut;
    public $motif;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $statut, $motif = null)
    {
        $this->user = $user;
        $this->statut = $statut;
        $this->motif = $motif;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Statut Entrepreneur Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.statut_entrepreneur',
        );
    }

    public function build()
    {
        return $this->markdown('emails.statut_entrepreneur')
            ->subject('Mise à jour de votre demande de stand')
            ->with([
                'user' => $this->user,
                'statut' => $this->statut,
                'motif' => $this->motif,
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
