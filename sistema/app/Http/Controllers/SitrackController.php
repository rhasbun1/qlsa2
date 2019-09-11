<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function solicitarSessionIDSitrack(Request $datos)
    {

        $USER_NAME       = "daviddiaz1402@gmail.com";
        $PASSWORD        = "itsoft802";
        $sessionResponse = null;
        $sessionId       = null;
        $secretKey       = null;

        // Para usar el servicio de reportes acumulados reemplazar el subcontexto de URL
        // por el siguiente: "/files/reports"
        //$subContext      = "/report?domain=".$datos->input('patente');
        $subContext      = "/report?domain=CFHK83";

        while (true) {
          try {
            if ($sessionId == null) {
              $encodedUserAndPassword = base64_encode($USER_NAME . ":" . $PASSWORD);
              $authParameters[]       = "Authorization: Basic " . $encodedUserAndPassword;
              $sessionResponse        = $this->miRequestHTTP("GET", "https://externalappgw.cl.sitrack.com", "/session/", $authParameters);
              
              if ($sessionResponse["http_code"] == 401) {
                return "Incorrect username or password";
              }
              $decode    = json_decode($sessionResponse["body"], TRUE);
              $sessionId = $decode["sessionId"];
              $secretKey = $decode["secretKey"];
            }
            
            $timestamp = time();
            $signature = base64_encode(hash("MD5", $sessionId . $secretKey . $timestamp, true));
            
            $authParameters   = array();
            $authParameters[] = "Authorization: StkAuth session=\"$sessionId\",signature=\"$signature\",timestamp=\"$timestamp\"";
            
            //IMPORTANTE: Reemplace xx por el código correspondiente a su país ar | br | cl | mx | uy | etc
            $response     = $this->miRequestHTTP("GET", "externalappgw.cl.sitrack.com", $subContext, $authParameters);
            $responseCode = $response["http_code"];
            
            if ($responseCode == "200") {
              // Aquí poner el código correspondiente al parseo del contenido.
              return $response["body"];

            } else if ($responseCode == "401") {
              $decodedResponse = json_decode($response["body"], TRUE);
              $errorCode       = $decodedResponse["errorCode"];
              
              if ($errorCode == "111") {
                $sessionId = null;
                $secretKey = null;

                try {
                  //Espera 30 segundos antes de renovar sesión.
                  sleep(30);
                } catch (InterruptedException $iex) {}

                //Comienza nuevamente el bucle principal sin ejecutar la espera larga de 5 minutos.
                continue;
              }
            } else {
                return "Unknown error";
            }
          } catch (Exception $ex) {}
          
          try {
            //Espera de 5 minutos entre consultas aunque se produzcan excepciones en el bloque principal.
            sleep(300);
          } catch (InterruptedException $iex) {}
        }

    }

    protected function miRequestHTTP($method, $server, $serviceContext, $authParameters) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($ch, CURLOPT_URL, $server . $serviceContext);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $authParameters);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $body = curl_exec($ch);
      
      $response         = curl_getinfo($ch);
      $response["body"] = $body;
      
      curl_close($ch);
      return $response;
    }

}
