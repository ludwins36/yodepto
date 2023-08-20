<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RecaptchaController extends Controller
{
    public function verifyRecaptcha(Request $request)
    {
        $secretKey = 'TU_CLAVE_SECRETA'; // Reemplaza con tu propia clave secreta

        $response = $request->input('recaptchaResponse');

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $secretKey,
                'response' => $response,
            ],
        ]);

        $body = json_decode((string) $response->getBody());

        if ($body->success) {
            // La respuesta del reCAPTCHA es válida
            // Continúa con el procesamiento del formulario o realiza alguna acción
            return response()->json(['success' => true]);
        } else {
            // La respuesta del reCAPTCHA es inválida
            // Puedes mostrar un mensaje de error o realizar alguna acción
            return response()->json(['success' => false, 'error' => 'La verificación de reCAPTCHA falló.']);
        }
    }
}
