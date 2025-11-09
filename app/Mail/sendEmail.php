<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * digunakan untuk menginisiasi object yang digunakan paa template email
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * digunakan untuk mengatur struktur email lebih spesifik.bisa untk menampilkan template email dan menambahkan attachment
     */
    public function build()
    {
        return $this->subject($this->data['subject'])
            ->view('emails.mail-template');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mail-template',
        );
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Email',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
