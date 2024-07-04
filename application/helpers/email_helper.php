<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('enviaCorreo')) {
    function enviaCorreo($correo, $titulo, $contenido)
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => API_OPENAPIS . "correos/v3/enviar",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "correo=" . rawurlencode($correo) . "&titulo=" . rawurlencode($titulo) . "&contenido=" . rawurlencode($contenido),
                CURLOPT_HTTPHEADER => array(
                    "Accept: /",
                    "Authorization: Basic ZW1lcmdlbnRlOjEyMzQ1Njc4OQ==",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/x-www-form-urlencoded",
                    "Host: www.openapis.col.gob.mx",
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return ($err) ? "cURL Error #:" . $err : $response;
    }
}
