<?php

namespace App\Mail;
use App\Models\User;
use App\Models\EmailVerifyToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailSendRequestChange extends Mailable
{
    use Queueable, SerializesModels;
    protected EmailVerifyToken $token;
    protected User $user;
    protected $change_required;
    /**
     * Create a new message instance.
     */
    public function __construct($user,$change_required)
    {
        $this->user = $user;
        $this->change_required = $change_required;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'support@code-playground.test',
            subject: '[CodePlayground] Congratulation! Your account has been created successfully.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content( 
            view: 'mails.company.request-change-mail',
            with: ['user' => $this->user,'change_required' => $this->change_required]
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
