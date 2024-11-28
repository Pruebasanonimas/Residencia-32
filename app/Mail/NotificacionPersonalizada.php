<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionPersonalizada extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Construir el correo con la vista y el asunto
        $email = $this->view('emails.notificacion')
            ->text('emails.notificacion_texto') // Vista alternativa para correo en texto plano
            ->subject($this->data['subject'])
            ->with('data', $this->data);

        // Adjuntar archivos (si existen)
        if (!empty($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $file) {
                if (file_exists($file->getPathname())) { // Verifica si el archivo existe
                    $email->attach($file->getPathname(), [
                        'as' => $file->getClientOriginalName(), // Nombre del archivo adjunto
                        'mime' => $file->getClientMimeType() // Tipo MIME
                    ]);
                }
            }
        }

        return $email;
    }
}
