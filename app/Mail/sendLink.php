<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendLink extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $resetUrl, string $userName = 'Pengguna')
    {
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Link Reset Password Anda',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.email_lupa_password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}