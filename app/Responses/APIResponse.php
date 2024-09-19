<?php

namespace App\Responses;

class APIResponse
{
    public ?string $message;
    public ?object $data;
    public function __construct(?string $message, ?object $data = null) {
        $this->message = $message;
        $this->data = $data;
    }
}
