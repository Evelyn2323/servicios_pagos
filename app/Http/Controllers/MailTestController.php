<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailTestController extends Controller
{
    public function sendTestEmail()
    {
        $data = ['message' => 'Este es un correo de prueba desde Laravel.'];
    
        // Depurar la variable $data
        dd($data);
    
        // El resto del código no se ejecutará debido a dd()
        Mail::send('emails.test', $data, function ($message) {
            $message->to('recipient@example.com', 'Nombre del destinatario')
                    ->subject('Correo de prueba Laravel');
        });
    
        return "Correo de prueba enviado!";
    }
    
}
