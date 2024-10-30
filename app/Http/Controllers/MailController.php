<?php

namespace App\Http\Controllers;
use App\Models\EvaluacionInvitado;
use Illuminate\Http\Request;
use Mailjet\Client;
use Mailjet\Resources;
//response



class MailController extends Controller
{
    public function sendEmail(Request $request)
{
    // Crear instancia de Mailjet Client
    $mj = new Client(env('MJ_APIKEY_PUBLIC'), env('MJ_APIKEY_PRIVATE'), true, ['version' => 'v3.1']);

    // Convertir el string de destinatarios en array usando explode
    $emails = explode(',', $request->destinatarios);

    if (empty($emails)) {
        return redirect()->back()->with('error', 'No se ha ingresado ningún destinatario');
    }

    $errores = [];
    $enviados = 0;

    foreach ($emails as $email) {
        $email = trim($email);

        // Configurar el cuerpo del mensaje para cada destinatario
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => env('SENDER_EMAIL'),
                        'Name'  => env('SENDER_NAME')
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name'  => 'Destinatario'
                        ]
                    ],
                    'Subject' => $request->asunto,
                    'HTMLPart' => $request->mensaje,
                ]
            ]
        ];

        // Intentar enviar el correo
        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Verificar si el envío fue exitoso
        if ($response->success()) {
            // Cambiar el estado de enviado para el destinatario actual
            $evaluacionInvitado = EvaluacionInvitado::where('evainv_correo', $email)
                ->where('inic_codigo', $request->iniciativa_codigo)
                ->where('evatotal_tipo', $request->invitado)
                ->where('evainv_estado', 0)
                ->first();

            if ($evaluacionInvitado) {
                $evaluacionInvitado->evainv_estado = 1;
                $evaluacionInvitado->save();
            }
            $enviados++;
        } else {
            // Agregar el email a la lista de errores si no se pudo enviar
            $errores[] = $email;
        }
    }

    // Retornar mensajes de éxito o error según corresponda
    if ($enviados > 0) {
        $mensajeExito = "¡Correo(s) enviado(s) correctamente!";
        if (!empty($errores)) {
            $mensajeExito .= " Sin embargo, los siguientes correos fallaron: " . implode(', ', $errores);
        }
        return redirect()->back()->with('exito', $mensajeExito);
    } else {
        return redirect()->back()->with('error', 'No se pudo enviar ningún correo');
    }
}

}
