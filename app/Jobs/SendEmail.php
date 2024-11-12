<?php

namespace App\Jobs;

use App\Mail\MailNotify;
use App\Models\Password_Reset_Tokens;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;
    protected string $email;
    protected Password_Reset_Tokens $token;
    /**
     * Create a new job instance.
     */
    public function __construct(string $email, Password_Reset_Tokens $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new MailNotify($this->token));
    }
}
