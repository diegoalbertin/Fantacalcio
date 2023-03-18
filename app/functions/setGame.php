<?php 
include_once dirname(__FILE__) ."/url.php";

function setGame($data)
    {
        $url = getPath().'/API/game/setGame.php';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url); // setta l'url
        curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa

        $headers = array(
            "Content-Type: application/json",
            "Content-Lenght: 0",
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $responseJson = curl_exec($curl);

        curl_close($curl);

    }

?>