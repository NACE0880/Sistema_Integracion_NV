<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CotizacionTicket extends Mailable
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
        $this->nombre_archivo = $this->data['ticket']->ARCHIVO_COTIZACION;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!is_null($this->nombre_archivo)) {
            $path = \Storage::disk('tickets_cotizaciones')->path($this->nombre_archivo);

            return $this->view('correos.ticketCotizado')
            ->with('data', $this->data)
            ->subject('Nueva Cotizacion Ticket')
            ->attach($path);

        } else {
            return $this->view('correos.ticketCotizado')
            ->with('data', $this->data)
            ->subject('Nueva Cotizacion Ticket')
            ;
        }

    }
}
