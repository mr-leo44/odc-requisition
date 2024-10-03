<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveriesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $req)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demandes de requisition interne',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.deliveries',
            with: [
                'req' => $this->req
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
        $title = $this->req->numero . "pdf";
        $pdf = Pdf::loadView('generatePdf.deliveries', ['req' => $this->req]);
        return [
            Attachment::fromData(fn() => $pdf->output(), "$title")
                ->withMime('application/pdf'),
        ];
    }
}
