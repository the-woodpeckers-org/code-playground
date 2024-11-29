<?php

namespace App\Mail;

use App\Models\Contest;
use App\Models\User;
use App\Models\EmailVerifyToken;
use App\Models\JobRecruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailInviteApply extends Mailable
{
    use Queueable, SerializesModels;
    protected User $invited_user;
    protected User $user_company;
    protected JobRecruitment $job;
    protected Contest $contest;
    /**
     * 
     * Create a new message instance.
     */
    public function __construct($invited_user,$user_company,$job,$contest)
    {
        $this->invited_user = $invited_user;
        $this->user_company = $user_company;
        $this->job = $job;
        $this->contest = $contest;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'support@code-playground.test',
            subject: '[CodePlayground] Invitation.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.company.invite-apply-email',
            with: ['invited_user' => $this->invited_user,'user_company'=>$this->user_company,'job'=>$this->job,'contest'=>$this->contest]
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
