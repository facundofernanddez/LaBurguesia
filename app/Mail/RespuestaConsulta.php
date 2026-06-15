<?php

namespace App\Mail;

use App\Models\Contacto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RespuestaConsulta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Contacto $contacto, public string $respuesta)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: Tu consulta en La Burguesía - ' . $this->contacto->motivo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.respuesta-consulta',
            with: [
                'nombre' => $this->contacto->nombre,
                'mensajeOriginal' => $this->contacto->mensaje,
                'respuesta' => $this->respuesta,
            ],
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
