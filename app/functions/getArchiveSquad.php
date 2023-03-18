<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveSquad(){
    $url = getPath()."API/squad/getArchiveSquad.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>