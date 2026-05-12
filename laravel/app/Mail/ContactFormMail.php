<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Aquí le decimos qué asunto tendrá y qué vista HTML va a usar
        return $this->subject('Nuevo Mensaje de Contacto - Screenbites')
                    ->view('emails.contact'); 
    }
}