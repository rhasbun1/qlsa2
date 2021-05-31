<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ReminderEmailDigest;
use App\Mail\enviarMailPedidoCreado;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recordatorio correos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //conseguir lor recordatorio ejemplo usar una query para traere los datos en un array
        $pedido = DB::Select('call spGetPedidosNoEnviados()');

        $pedidosPorHabilitar = DB::Select('call spGetPedidosCorreo()'); 

        //agrupar por user

        // enviar mail
       // $this->sendEmailtoUser($pedido);
        $this->emailPedidoCreado($pedidosPorHabilitar);
    }

    private function sendEmailtoUser($pedido)
    {
        $usuario = "2eee28cdd9-c936e7@inbox.mailtrap.io";

        Mail::to($usuario)->send(new ReminderEmailDigest($pedido));
    }

    private function emailPedidoCreado($pedido)
    {
        $usuario = "2eee28cdd9-c936e7@inbox.mailtrap.io";

        Mail::to($usuario)->send(new enviarMailPedidoCreado($pedido));
    }
}
