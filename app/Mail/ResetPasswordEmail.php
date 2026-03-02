<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// 👇 1. YEH LINE ERROR KHATAM KAREGI
use Illuminate\Mail\Mailables\Address; 

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $email;

    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // 👇 2. HUM NE KHUD BATA DIYA EMAIL KON BHEJ RAHA HAI (Null issue fixed)
            from: new Address('admin@larabook.com', 'LaraBook Admin'),
            subject: 'Reset Your Password - LaraBook 🔐',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}