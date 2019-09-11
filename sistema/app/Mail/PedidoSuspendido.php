<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PedidoSuspendido extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;

    public function __construct($pedido)
    {
        //
        $this->pedido = $pedido;
    }

    public function build()
    {
        return $this->view('formatosEmail.avisoPedidoSuspendido');
    }
}
