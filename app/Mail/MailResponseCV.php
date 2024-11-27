<?php

namespace App\Mail;

use App\Models\User;
use App\Models\EmailVerifyToken;
use App\Models\JobRecruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailResponseCV extends Mailable
{
    use Queueable, SerializesModels;
    protected EmailVerifyToken $token;
    protected User $userApply;
    protected User $user_company;
    protected JobRecruitment $job;
    protected $status;
    /**
     * 
     * Create a new message instance.
     */
    public function __construct($userApply, $user_company, $job,$status)
    {
        $this->userApply = $userApply;
        $this->user_company = $user_company;
        $this->job = $job;
        $this->status = $status;
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
            view: 'mails.company.response-cv-apply-mail',
            with: ['userApply' => $this->userApply, 'user_company' => $this->user_company, 'job' => $this->job,'status'=>$this->status]
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
