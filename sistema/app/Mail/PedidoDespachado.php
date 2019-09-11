<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PedidoSuspendido extends Mailable
{
    use Queueable, SerializesModels;

    public $guia;

    public function __construct($guia)
    {
        //
        $this->guia = $guia;
    }

    public function build()
    {
        return $this->view('formatosEmail.avisoPedidoDespachado');
    }
}
