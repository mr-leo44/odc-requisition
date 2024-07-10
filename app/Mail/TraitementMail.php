<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TraitementMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $demande, public $success = false, public $is_validator = false)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande de requisition interne',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.traitements',
            with: [
                'demande_id' => $this->demande->id,
                'observation'=> $this->demande->observation,
                'num_demande' => $this->demande->numero,
                'demandeur' => $this->demande->user->name,
                'validateur' => $this->demande->validateur,
                'validated' => $this->demande->validated,
                'is_validator' => $this->is_validator,
                'success' => $this->success,
                'level' => $this->demande->level
            ]
        );
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
