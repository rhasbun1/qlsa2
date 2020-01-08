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

    public function solicitarSessionIDSitrack_old(Request $datos)
    {

        $USER_NAME       = "ws19985TransportesPraga";
        $PASSWORD        = "Itsoft$802";
        $sessionResponse = null;
        $sessionId       = null;
        $secretKey       = null;

        $subContext      = "/report?domain=".$datos->input('patente');

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

    public function solicitarSessionIDSitrack(Request $datos){
        $USER_NAME = "ws19985TransportesPraga";
        $PASSWORD = "Itsoft$802";
        $sessionResponse = null;
        $sessionId       = null;
        $secretKey       = null;
         
        //IMPORTANTE: reemplazar xx por el código de país ar | br | cl | mx | uy correspondiente, 
        //y al momento de desplegar en producción quitar el descriptor test- del dominio.
         
        $SITRACK_DOMAIN = "https://test-externalappgw.cl.sitrack.com";
         
        // Para usar el servicio de reportes acumulados reemplazar "/report" por "/files/reports"
        $subContext = "/report?domain=".$datos->input('patente');
         
        while (true) {
          try {
            if ($sessionId == null) {
              $encodedUserAndPassword = base64_encode($USER_NAME . ":" . $PASSWORD);
              $authParameters[] = "Authorization: Basic " . $encodedUserAndPassword;
              $sessionResponse = $this->requestHTTP("GET", $SITRACK_DOMAIN, "/session", $authParameters);
         
              if ($sessionResponse["http_code"] == 401) {
                exit("Response: HTTP ".$sessionResponse["http_code"]."\n".$sessionResponse["body"]);
              }
         
              $decode    = json_decode($sessionResponse["body"], TRUE);
              $sessionId = $decode["sessionId"];
              $secretKey = $decode["secretKey"];
            }
            $timestamp = time();
            $signature = base64_encode(hash("MD5", $sessionId . $secretKey . $timestamp, true));
         
            $authParameters   = array();
            $authParameters[] = "Authorization: StkAuth session=\"$sessionId\",signature=\"$signature\",timestamp=\"$timestamp\"";
         
            $response     = $this->requestHTTP("GET", $SITRACK_DOMAIN, $subContext, $authParameters);
            $responseCode = $response["http_code"];
            $responseBody = $response["body"];
         
            header('Content-Type: '.$response["content_type"]);
         
            echo "Response: HTTP $responseCode\n$responseBody";    
         
            if ($responseCode == "200") {
                // Aquí colocar el código correspondiente al parseo del contenido.
         
            } else if ($responseCode == "401") {
              $decodedResponse = json_decode($responseBody, TRUE);
              $errorCode       = $decodedResponse["errorCode"];
         
              if ($errorCode == "111") {
                $sessionId = null;
                $secretKey = null;
         
                try {
                  //Espera 10 segundos antes de renovar sesión.
                  sleep(10);
                } catch (InterruptedException $iex) {}
         
                //Comienza nuevamente el bucle principal
                continue;
              }
            }
          } catch (Exception $ex) {
            echo $ex;
          }
          try {  
            //Espera de 5 minutos entre consultas aunque se produzcan excepciones en el bloque principal.  
            sleep(300);  
          } catch (InterruptedException $iex) {}
        }

    }

    function requestHTTP($method, $server, $serviceContext, $authParameters) {
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
