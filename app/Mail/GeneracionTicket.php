<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneracionTicket extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data){

        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){

        //return $this->view('correos.MeTicketeo')->render();

        return $this->view('correos.ticket')
        ->with('data', $this->data)
        ->subject('Informe de Nuevo Ticket');
        
    }
    
}
