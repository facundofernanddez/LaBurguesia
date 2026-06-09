<?php

namespace App\Mail;

use App\Models\Contacto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultaRecibida extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contacto $contacto)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Consulta Recibida - La Burguesía',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.consulta-recibida',
            with: [
                'nombre' => $this->contacto->nombre,
                'motivo' => $this->contacto->motivo,
                'logoUrl' => asset('img/logo.png'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
