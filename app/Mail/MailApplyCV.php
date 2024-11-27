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

class MailApplyCV extends Mailable
{
    use Queueable, SerializesModels;
    protected EmailVerifyToken $token;
    protected User $userApply;
    protected User $user_company;
    protected $application;
    protected $user_profile;
    /**
     * 
     * Create a new message instance.
     */
    public function __construct($userApply,$user_profile,$user_company,$application)
    {
        $this->userApply = $userApply;
        $this->user_company = $user_company;
        $this->application = $application;
        $this->user_profile = $user_profile;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'support@code-playground.test',
            subject: '[CodePlayground] Notifications.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.company.apply-cv-email',
            with: ['userApply' => $this->userApply,'userProfile'=>$this->user_profile,'user_company'=>$this->user_company,'application'=>$this->application]
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
