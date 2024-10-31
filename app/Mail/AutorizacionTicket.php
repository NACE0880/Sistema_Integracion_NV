<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutorizacionTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->nombre_archivo = $this->data['ticket']->ARCHIVO_AUTORIZACION;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!is_null($this->nombre_archivo)) {
            $path = \Storage::disk('tickets_autorizaciones')->path($this->nombre_archivo);

            return $this->view('correos.ticketAutorizado')
            ->with('data', $this->data)
            ->subject('Nueva Autorizacion Ticket')
            ->attach($path);

        } else {
            return $this->view('correos.ticketAutorizado')
            ->with('data', $this->data)
            ->subject('Nueva Autorizacion Ticket')
            ;
        }

    }
}
