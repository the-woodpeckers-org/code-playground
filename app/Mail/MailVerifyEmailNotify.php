<?php

namespace App\Mail;

use App\Models\EmailVerifyToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailVerifyEmailNotify extends Mailable
{
    use Queueable, SerializesModels;
    protected EmailVerifyToken $token;
    /**
     * Create a new message instance.
     */
    public function __construct(EmailVerifyToken $token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'support@code-playground.test',
            subject: '[CodePlayground] Verify your email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.verify-email',
            with: ['token' => $this->token]
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
