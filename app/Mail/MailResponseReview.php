<?php

namespace App\Mail;

use App\Models\Contest;
use App\Models\User;
use App\Models\EmailVerifyToken;
use App\Models\JobRecruitment;
use App\Models\Problem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailResponseReview extends Mailable
{
    use Queueable, SerializesModels;
    protected EmailVerifyToken $token;

    protected User $user;
    protected ?Problem $problem;
    protected ?Contest $contest;
    protected $status;
    /**
     * 
     * Create a new message instance.
     */
    public function __construct($user, $problem = null, $contest = null, $status)
{
    $this->user = $user;
    $this->problem = $problem;
    $this->contest = $contest;
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
            view: 'mails.company.response-review-mail',
            with: [
                'user' => $this->user,
                'problem' => $this->problem ?? null,
                'contest' => $this->contest ?? null,
                'status' => $this->status,
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
